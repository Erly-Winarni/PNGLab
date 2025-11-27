<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function complete(Content $content)
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
        // Pastikan konten milik course tersebut
        if ($content->course_id !== $course->id) {
            abort(404);
        }

        $student = auth()->user();

        // Cek apakah konten ini sudah diselesaikan oleh student
        $isCompleted = $student->completedContents()
            ->where('content_id', $content->id)
            ->exists();

        // Ambil konten sebelumnya berdasarkan urutan
        $previous = $course->contents()
            ->where('order', $content->order - 1)
            ->first();

        // Cek apakah konten sebelumnya sudah selesai
        $previousCompleted = $previous
            ? $student->completedContents()
                ->where('content_id', $previous->id)
                ->exists()
            : true; // kalau tidak ada konten sebelumnya, anggap boleh dibuka

        return view('student.contents.show', compact(
            'course',
            'content',
            'isCompleted',
            'previousCompleted',
            'previous'
        ));
    }
}
