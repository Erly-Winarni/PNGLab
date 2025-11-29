<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Content;

class CourseController extends Controller
{
    // Tampilkan catalog
    public function catalog()
    {
        $user = auth()->user();

        $courses = Course::with('teacher', 'contents')->get();

        // Hitung progress untuk setiap course yang sudah diikuti
        foreach ($courses as $course) {
            $completed = $course->contents()
                ->whereHas('completedBy', fn($q) => $q->where('user_id', $user->id))
                ->count();

            $course->progress = $course->contents->count() > 0
                ? round(($completed / $course->contents->count()) * 100)
                : 0;

            $course->is_followed = $user->courses()->where('course_id', $course->id)->exists();
        }

        return view('student.courses.index', compact('courses'));
    }

    // Follow course
    public function follow(Course $course)
    {
        $user = auth()->user();

        $user->courses()->syncWithoutDetaching([$course->id]);

        return back()->with('success', 'Berhasil mengikuti course!');
    }

    // Show course detail
    public function show(Course $course)
    {
        $user = auth()->user();

        $contents = $course->contents()->orderBy('order')->get();

        // Tandai completed
        foreach ($contents as $content) {
            $content->is_completed = $user->contentProgress()
                ->where('content_id', $content->id)
                ->where('is_done', true)
                ->exists();
        }

        // Hitung progress
        $completedCount = $contents->where('is_completed', true)->count();
        $course->progress = $contents->count() > 0
            ? round(($completedCount / $contents->count()) * 100)
            : 0;

        return view('student.courses.show', compact('course', 'contents'));
    }

    public function complete(Content $content)
    {
        $user = auth()->user();

        // Tandai bahwa user menyelesaikan konten ini
        $content->completedBy()->syncWithoutDetaching([$user->id]);

        return back()->with('success', 'Materi ditandai selesai!');
    }

}
