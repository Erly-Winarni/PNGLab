<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = ['user' => $user];

        if ($user->role === 'student') {

            $courses = $user->courses()
                ->with([
                    'teacher',
                    'category',
                    'contents',
                    'contents.completedBy' => fn($q) => $q->where('user_id', $user->id)
                ])
                ->paginate(5);

            foreach ($courses as $course) {
                $total = $course->contents->count();

                $completed = $course->contents
                    ->filter(fn($c) => $c->completedBy->isNotEmpty())
                    ->count();

                $course->progress = $total > 0
                    ? round(($completed / $total) * 100)
                    : 0;
            }

            $data['courses'] = $courses;
        }

        if ($user->role === 'teacher') {
            $data['courses'] = Course::where('teacher_id', $user->id)
                ->withCount('students')
                ->with('category')
                ->paginate(3);
        }

        if ($user->role === 'admin') {
            $data['totalUsers'] = User::count();
            $data['totalStudents'] = User::where('role', 'student')->count();
            $data['totalTeachers'] = User::where('role', 'teacher')->count();
            $data['totalCourses'] = Course::count();
        }

        return view('profile.index', $data);
    }


    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email:rfc,dns',
            ],
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berformat jpg, jpeg atau png.',
            'avatar.max' => 'Ukuran avatar tidak boleh lebih dari 2MB.',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diperbarui!');
    }

    public function editPassword()
    {
        $user = auth()->user();
        return view('profile.password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],
        ], [
            'current_password.required' => 'Password lama harus diisi.',
            'password.required' => 'Password baru harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung minimal 1 huruf besar, huruf kecil, angka, dan simbol.',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Password berhasil diperbarui!');
    }
}
