<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class PublicCourseController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $coursesQuery = Course::withCount('students')
            ->where('is_active', 1);

        if ($request->filled('search') || $request->filled('category')) {
            if ($request->filled('search')) {
                $coursesQuery->where('title', 'like', "%{$request->search}%");
            }

            if ($request->filled('category')) {
                $coursesQuery->where('category_id', $request->category);
            }

            $topCourses = $coursesQuery
                ->orderBy('students_count', 'desc')
                ->get(); 
        } else {
            $topCourses = $coursesQuery
                ->orderBy('students_count', 'desc')
                ->take(5)
                ->get();
        }

        return view('public.index', compact('topCourses', 'categories'));
    }

}
