<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class PublicCourseController extends Controller
{
    public function index()
    {
        $topCourses = Course::withCount('students')
            ->where('is_active', 1)
            ->orderBy('students_count', 'desc')
            ->take(5)
            ->get();

        $categories = Category::all();

        return view('public.index', compact('topCourses', 'categories'));
    }

}
