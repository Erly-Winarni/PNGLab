<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::with('teacher','course')->paginate(15);
        return view('admin.contents.index', compact('contents'));
    }

    public function create()
    {
        $courses = Course::all();
        $teachers = User::where('role', 'teacher')->get(); 

        return view('admin.contents.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
            'media_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        Content::create($request->only('title','body','course_id','teacher_id','media_url','order'));

        return redirect()->route('admin.contents.index')->with('success','Materi berhasil dibuat.');
    }

    public function edit(Content $content)
    {
        $courses = Course::all();
        $teachers = User::where('role', 'teacher')->get(); // 🔥 tambahkan ini

        return view('admin.contents.edit', compact('content', 'courses', 'teachers'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
            'media_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $content->update($request->only('title','body','course_id','teacher_id','media_url','order'));

        return redirect()->route('admin.contents.index')->with('success','Materi berhasil diperbarui.');
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return redirect()->route('admin.contents.index')
            ->with('success', 'Materi berhasil dihapus.');
    }

    private function detectMediaType($url)
    {
        if (!$url) return null;

        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
            return 'youtube';
        }

        if (str_ends_with($url, '.pdf')) return 'pdf';
        if (str_ends_with($url, '.doc') || str_ends_with($url, '.docx')) return 'doc';

        return 'url'; // default
    }
}
