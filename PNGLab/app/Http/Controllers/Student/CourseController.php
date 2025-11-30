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

        // Query dasar
        $coursesQuery = Course::with(['teacher', 'contents', 'category']);

        // Search
        if ($request->filled('search')) {
            $coursesQuery->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->filled('category')) {
            $coursesQuery->where('category_id', $request->category);
        }

        // Pagination → untuk links()
        $courses = $coursesQuery->paginate(9);

        // Tambahkan progress & status follow
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

        // Ambil kategori (dropdown)
        $categories = Category::all();

        return view('student.courses.index', compact(
            'courses',
            'categories',
        ));
    }

    public function follow(Course $course)
    {
        $user = auth()->user();

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

    public function complete(Content $content)
    {
        $user = auth()->user();

        $content->completedBy()->syncWithoutDetaching([$user->id]);

        return back()->with('success', 'Materi ditandai selesai!');
    }

}
