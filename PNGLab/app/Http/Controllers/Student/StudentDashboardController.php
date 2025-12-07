<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $categories = Category::all();

        $coursesQuery = Course::with(['teacher', 'category'])
            ->where('is_active', 1);

        if ($request->filled('search') || $request->filled('category')) {
            if ($request->filled('search')) {
                $coursesQuery->where('title', 'like', "%{$request->search}%");
            }

            if ($request->filled('category')) {
                $coursesQuery->where('category_id', $request->category);
            }

            $topCourses = $coursesQuery->withCount('students')
                ->orderBy('students_count', 'desc') 
                ->get();
        } else {
           
            $topCourses = $coursesQuery->withCount('students')
                ->orderBy('students_count', 'desc')
                ->take(5)
                ->get();
        }

        return view('student.dashboard', compact('user', 'topCourses', 'categories'));
    }
}
