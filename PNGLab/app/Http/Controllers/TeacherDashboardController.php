<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();

        // Semua course yang dibuat teacher ini
        $courses = Course::with('category')
            ->withCount('students')
            ->where('teacher_id', $teacher->id)
            ->get();

        // Total student dari semua course
        $totalStudents = $courses->sum('students_count');

        return view('teacher.dashboard', compact('courses', 'totalStudents'));
    }
}
