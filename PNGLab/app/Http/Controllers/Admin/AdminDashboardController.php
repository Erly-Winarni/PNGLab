<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalCategories = Category::count();
        $totalTeachers = User::where('role', 'teacher')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalCourses', 'totalCategories', 'totalTeachers'));
    }
}
