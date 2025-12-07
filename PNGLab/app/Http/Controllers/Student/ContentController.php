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
        
        $user->contentProgress()->syncWithoutDetaching([
            $content->id => [
                'is_done' => true,
                'done_at' => now(),
            ]
        ]);

        return redirect()
        ->route('student.contents.show', [
            'course' => $course->slug,
            'content' => $content->id
        ])
        ->with('success', 'Konten telah ditandai selesai.');
    }

    public function show(Course $course, Content $content)
    {
        $student = auth()->user();

        $requiredCount = Content::where('course_id', $content->course_id)
            ->where('order', '<', $content->order)
            ->count();

        $completedCount = $student->contentProgress()
            ->wherePivot('is_done', true)
            ->wherePivotIn('content_id', Content::where('course_id', $content->course_id)
                ->where('order', '<', $content->order)
                ->pluck('id')
            )
            ->count();

        $previousCompleted = ($completedCount === $requiredCount);

        $isCompleted = $student->contentProgress()
            ->where('content_id', $content->id)
            ->where('is_done', true)
            ->exists();

        return view('student.contents.show', compact(
            'content',
            'isCompleted',
            'previousCompleted'
        ));
    }

    public function uncomplete(Course $course, Content $content)
    {
        $user = auth()->user();

        $user->contentProgress()->updateExistingPivot($content->id, [
            'is_done' => false,
            'done_at' => null,
        ]);

        return back()->with('success', 'Status materi dibatalkan.');
    }


}
