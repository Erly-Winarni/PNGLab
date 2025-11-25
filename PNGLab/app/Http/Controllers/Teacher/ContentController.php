<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::where('teacher_id', auth()->id())->paginate(10);
        return view('teacher.contents.index', compact('contents'));
    }

    public function create()
    {
        $courses = Course::where('teacher_id', auth()->id())->get();
        return view('teacher.contents.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'media_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        Content::create([
            'title' => $request->title,
            'body' => $request->body,
            'course_id' => $request->course_id,
            'teacher_id' => auth()->id(),
            'media_url' => $request->media_url,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('teacher.contents.index')->with('success','Materi berhasil dibuat.');
    }

    public function edit(Content $content)
    {
        if ($content->teacher_id !== auth()->id()) abort(403);

        $courses = Course::where('teacher_id', auth()->id())->get();
        return view('teacher.contents.edit', compact('content','courses'));
    }

    public function update(Request $request, Content $content)
    {
        if($content->teacher_id !== auth()->id()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'media_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $content->update($request->only('title','body','course_id','media_url','order'));

        return redirect()->route('teacher.contents.index')->with('success','Materi berhasil diperbarui.');
    }

    public function destroy(Content $content)
    {
        if ($content->teacher_id !== auth()->id()) abort(403);

        $content->delete();

        return redirect()->route('teacher.contents.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
