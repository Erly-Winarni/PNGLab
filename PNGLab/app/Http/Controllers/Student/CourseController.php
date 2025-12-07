<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Content;
use App\Models\Category;   

class CourseController extends Controller
{
    public function catalog(Request $request)
    {
        $user = auth()->user();

        $coursesQuery = Course::with(['teacher', 'contents', 'category'])
            ->where('is_active', 1); 

        if ($request->filled('search')) {
            $coursesQuery->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $coursesQuery->where('category_id', $request->category);
        }

        $courses = $coursesQuery->paginate(9);

        foreach ($courses as $course) {
            $completed = $course->contents()
                ->whereHas('completedBy', fn($q) => $q->where('user_id', $user->id))
                ->count();

            $course->progress = $course->contents->count() > 0
                ? round(($completed / $course->contents->count()) * 100)
                : 0;

            $course->is_followed = $user->courses()
                ->where('course_id', $course->id)
                ->exists();
        }

        $categories = Category::all();

        return view('student.courses.index', compact(
            'courses',
            'categories',
        ));
    }

    public function follow(Course $course)
    {
        $user = auth()->user();

        $currentCount = $course->students()->count(); 

        if ($course->max_students !== null && $currentCount >= $course->max_students) {
            return back()->with('error', 'Kelas ini sudah penuh dan tidak dapat diikuti.');
        }

        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('info', 'Kamu sudah mengikuti kelas ini.');
        }

        $user->courses()->syncWithoutDetaching([$course->id]);

        return back()->with('success', 'Berhasil mengikuti course!');
    }

    public function show(Course $course)
    {
        $user = auth()->user();

        $contents = $course->contents()->orderBy('order')->get();

        foreach ($contents as $content) {
            $content->is_completed = $user->contentProgress()
                ->where('content_id', $content->id)
                ->where('is_done', true)
                ->exists();
        }

        $completedCount = $contents->where('is_completed', true)->count();
        $course->progress = $contents->count() > 0
            ? round(($completedCount / $contents->count()) * 100)
            : 0;

        return view('student.courses.show', compact('course', 'contents'));
    }

}
