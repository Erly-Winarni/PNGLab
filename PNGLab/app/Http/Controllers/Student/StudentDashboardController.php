<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)->get(); // Hanya course aktif
        return view('student.dashboard', compact('courses'));
    }

    public function showCourse(Course $course)
    {
        // Materi urut berdasarkan order
        $contents = $course->contents()->orderBy('order')->get();

        // Ambil progress user saat ini
        $progress = auth()->user()->contentProgress()
                        ->whereIn('content_id', $contents->pluck('id'))
                        ->pluck('is_done', 'content_id')
                        ->toArray();

        return view('student.course_show', compact('course', 'contents', 'progress'));
    }

    public function completeContent(Content $content)
    {
        $user = auth()->user();

        $user->contentProgress()->updateOrCreate(
            ['content_id' => $content->id],
            ['is_done' => true, 'done_at' => now()]
        );

        return redirect()->back()->with('success', 'Materi ditandai selesai!');
    }


    public function followCourse(Course $course)
    {
        auth()->user()->courses()->syncWithoutDetaching([$course->id]);
        return redirect()->back()->with('success', 'Course diikuti!');
    }

}
