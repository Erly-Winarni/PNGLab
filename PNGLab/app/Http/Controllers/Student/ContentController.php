<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function complete(Course $course, Content $content)
    {
        $user = auth()->user();

        // Tandai selesai di pivot content_progress
        $user->contentProgress()->syncWithoutDetaching([
            $content->id => [
                'is_done' => true,
                'done_at' => now(),
            ]
        ]);

        // Ambil konten berikutnya
        $nextContent = $content->course
            ->contents()
            ->where('order', '>', $content->order)
            ->orderBy('order')
            ->first();

        if ($nextContent) {
            return redirect()
                ->route('student.courses.show', $content->course->slug)
                ->with('success', 'Konten selesai! Lanjut ke materi berikutnya.');
        }

        return back()->with('success', 'Konten selesai!');
    }

    public function show(Course $course, Content $content)
    {
        $student = auth()->user();

        // Cek apakah konten ini sudah diselesaikan oleh student
        $isCompleted = $content->is_completed;

        // Ambil konten sebelumnya
        $previous = Content::where('course_id', $content->course_id)
            ->where('order', '<', $content->order)
            ->orderBy('order', 'desc')
            ->first();

        // Cek apakah konten sebelumnya sudah selesai
        $previousCompleted = $previous
            ? $previous->completedBy()->where('user_id', $student->id)->exists()
            : true;

        return view('student.contents.show', compact(
            'content',
            'isCompleted',
            'previousCompleted',
            'previous'
        ));
    }

    public function uncomplete(Course $course, Content $content)
    {
        $user = auth()->user();

        // Update pivot is_done => false
        $user->contentProgress()->updateExistingPivot($content->id, [
            'is_done' => false,
            'done_at' => null,
        ]);

        return back()->with('success', 'Status materi dibatalkan.');
    }


}
