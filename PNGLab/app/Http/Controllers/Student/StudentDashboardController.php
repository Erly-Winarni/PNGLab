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

        $coursesQuery = Course::with(['teacher', 'category'])
            ->where('is_active', 1); 

        
        if ($request->filled('search')) {
            $coursesQuery->where('title', 'like', "%{$request->search}%");
        }

        
        if ($request->filled('category')) {
            $coursesQuery->where('category_id', $request->category);
        }

        $courses = $coursesQuery->get();

       $topCourses = Course::withCount('students')
            ->where('is_active', 1)
            ->orderBy('students_count', 'desc')
            ->take(5)
            ->get();

        $categories = \App\Models\Category::all();

        return view('student.dashboard', compact('user', 'courses', 'topCourses', 'categories'));
    }
}
