<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ContentProgress;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function studentDashboard()
    {
        $user = auth()->user();

        // Ambil semua course yang diikuti student
        $courses = $user->courses()
            ->withCount('contents')
            ->with('category')
            ->get();

        // Hitung progress masing-masing course
        foreach ($courses as $course) {
            $completed = ContentProgress::where('user_id', $user->id)
                ->whereIn('content_id', $course->contents->pluck('id'))
                ->count();

            $total = $course->contents_count;

            $course->progress = $total > 0 ? round(($completed / $total) * 100) : 0;
        }

        // Ambil kategori favorit user
        $favoriteCategoryId = $courses
            ->groupBy('category_id')
            ->sortByDesc(fn ($group) => $group->count())
            ->keys()
            ->first();

        // Rekomendasi course berdasarkan kategori favorit
        $recommendations = Course::where('category_id', $favoriteCategoryId)
            ->whereNotIn('id', $courses->pluck('id'))
            ->limit(4)
            ->get();

        return view('student.dashboard', compact('courses', 'recommendations'));
    }
}
