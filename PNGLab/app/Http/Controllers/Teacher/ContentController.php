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
            'title' => 'required|string',
            'body' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'media_url' => 'nullable|string',
            'media_file' => 'nullable|file|mimes:pdf,doc,docx',
            'order' => 'nullable|integer|min:0',
        ]);

        $mediaPath = null;
        $mediaType = null;

        // Jika upload file
        if ($request->hasFile('media_file')) {
            $mediaPath = $request->file('media_file')->store('media', 'public');
            $ext = $request->file('media_file')->getClientOriginalExtension();

            if ($ext == 'pdf') $mediaType = 'pdf';
            if ($ext == 'doc' || $ext == 'docx') $mediaType = 'doc';
        }
        // Jika input URL
        else if ($request->media_url) {
            $mediaType = $this->detectMediaType($request->media_url);
        }

        Content::create([
            'title' => $request->title,
            'body' => $request->body,
            'course_id' => $request->course_id,
            'teacher_id' => auth()->id(),
            'media_url' => $request->media_url,
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
            'order' => $request->order ?? 0,
        ]);

        return redirect()
            ->route('teacher.contents.index')
            ->with('success','Materi berhasil dibuat.');
    }


    public function edit(Content $content)
    {
        if ($content->teacher_id !== auth()->id()) abort(403);

        $courses = Course::where('teacher_id', auth()->id())->get();
        return view('teacher.contents.edit', compact('content','courses'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required',
            'body'  => 'required',
            'course_id' => 'required|exists:courses,id',
            'media_url' => 'nullable|string',
            'media_file' => 'nullable|file|mimes:pdf,doc,docx|max:5048',
            'order' => 'required|integer',
        ]);

        $mediaType = null;
        $mediaPath = $content->media_path;
        $mediaUrl  = $content->media_url;

        // Detect URL
        if ($request->media_url) {
            [$mediaType, $mediaUrl] = $this->detectUrlType($request->media_url);
        }

        // Upload file baru
        if ($request->hasFile('media_file')) {

            // Hapus file lama jika ada
            if ($content->media_path && \Storage::disk('public')->exists($content->media_path)) {
                \Storage::disk('public')->delete($content->media_path);
            }

            $file = $request->file('media_file');
            $mediaPath = $file->store('contents', 'public');

            // Tentukan tipe
            $ext = $file->getClientOriginalExtension();

            if ($ext === 'pdf') $mediaType = 'file_pdf';
            elseif ($ext === 'doc') $mediaType = 'file_doc';
            elseif ($ext === 'docx') $mediaType = 'file_docx';
        }

        $content->update([
            'title'      => $request->title,
            'body'       => $request->body,
            'course_id'  => $request->course_id,
            'media_url'  => $mediaUrl,
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
            'order'      => $request->order,
        ]);

        return redirect()
            ->route('teacher.contents.index')
            ->with('success', 'Materi berhasil diperbarui!');
    }



    public function destroy(Content $content)
    {
        if ($content->teacher_id !== auth()->id()) abort(403);

        $content->delete();

        return redirect()->route('teacher.contents.index')
            ->with('success', 'Materi berhasil dihapus.');
    }

    private function detectUrlType($url)
    {
        if (!$url) return null;

        // YouTube
        if (preg_match('/youtu\.be|youtube\.com/', $url)) {
            return 'youtube';
        }

        // PDF
        if (str_ends_with($url, '.pdf')) {
            return 'pdf';
        }

        // DOC
        if (str_ends_with($url, '.doc')) {
            return 'doc';
        }

        // DOCX
        if (str_ends_with($url, '.docx')) {
            return 'docx';
        }

        return null;
    }



}
