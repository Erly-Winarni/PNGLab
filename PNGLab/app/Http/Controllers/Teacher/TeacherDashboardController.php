<?php

namespace App\Http\Controllers\Teacher; 

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();

        $courses = Course::with('category')
            ->withCount('students')
            ->where('teacher_id', $teacher->id)
            ->paginate(3);

        $totalStudents = $courses->sum('students_count');

        return view('teacher.dashboard', compact('courses', 'totalStudents'));
    }
}
