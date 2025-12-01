<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => [
                'required',
                'string',
                'max:255',
                'unique:users',
                'email:rfc,dns',
            ],
            'password'  => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],
            'role'      => ['required', 'in:student,teacher'],
            'avatar'    => ['nullable', 'image', 'max:2048'],
        ], [
           
            'name.required'         => 'Nama wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.unique'          => 'Email ini sudah terdaftar.',
            'email.email' => 'Format email tidak valid.',

            'password.required'     => 'Password wajib diisi.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
            'password.min'          => 'Password minimal 8 karakter.',
            'password.regex'        => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',

            'role.required'         => 'Role wajib dipilih.',
            'role.in'               => 'Role tidak valid.',

            'avatar.image'          => 'Avatar harus berupa gambar.',
            'avatar.max'            => 'Avatar maksimal 2MB.',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'avatar'   => $avatarPath,
        ]);

        event(new Registered($user));

        auth()->login($user);

        return $user->role === 'teacher'
            ? redirect()->route('teacher.dashboard')
            : redirect()->route('student.dashboard');
    }
}
