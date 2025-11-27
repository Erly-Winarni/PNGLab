<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Query dasar
        $coursesQuery = Course::with(['teacher', 'category']);

        // SEARCH
        if ($request->filled('search')) {
            $coursesQuery->where('title', 'like', "%{$request->search}%");
        }

        // FILTER KATEGORI
        if ($request->filled('category')) {
            $coursesQuery->where('category_id', $request->category);
        }

        // Ambil hasil
        $courses = $coursesQuery->get();

        // Popular course
        $popularCourses = Course::withCount('students')
            ->orderByDesc('students_count')
            ->take(5)
            ->get();

        // Data kategori
        $categories = \App\Models\Category::all();

        return view('student.dashboard', compact('user', 'courses', 'popularCourses', 'categories'));
    }
}
