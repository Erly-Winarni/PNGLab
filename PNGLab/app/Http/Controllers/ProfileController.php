<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data = [
            'user' => $user,
        ];

        // Student
        if ($user->role === 'student') {
            $data['courses'] = $user->courses()
                ->with(['contents', 'teacher'])
                ->get();

            foreach ($data['courses'] as $course) {
                $completed = $course->contents()
                    ->whereHas('completedBy', fn($q) => $q->where('user_id', $user->id))
                    ->count();

                $course->progress = $course->contents->count() > 0
                    ? round(($completed / $course->contents->count()) * 100)
                    : 0;
            }
        }

        // Teacher
        if ($user->role === 'teacher') {
            $data['courses'] = Course::where('teacher_id', $user->id)
                ->withCount('students')
                ->with('category')
                ->get();
        }

        // Admin
        if ($user->role === 'admin') {
            $data['totalUsers'] = \App\Models\User::count();
            $data['totalStudents'] = \App\Models\User::where('role', 'student')->count();
            $data['totalTeachers'] = \App\Models\User::where('role', 'teacher')->count();
            $data['totalCourses'] = \App\Models\Course::count();
        }

        return view('profile.index', $data);
    }

    // ==========================
    //     EDIT PROFILE
    // ==========================
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'password' => 'required|min:6|confirmed',
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
