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

            // multiple URL
            'media_urls.*' => 'nullable|string',

            // multiple PDF
            'media_files.*' => 'nullable|file|mimes:pdf',
        ]);

        $content = Content::create([
            'title'      => $request->title,
            'body'       => $request->body,
            'course_id'  => $request->course_id,
            'teacher_id' => auth()->id(),
            'order'      => $request->order ?? 0,
        ]);

        /* ====== SIMPAN URL ====== */
        if ($request->media_urls) {
            foreach ($request->media_urls as $url) {
                if ($url) {
                    $content->media()->create([
                        'type'  => $this->detectUrlType($url),
                        'value' => $url,
                    ]);
                }
            }
        }

        /* ====== SIMPAN FILE PDF MULTIPLE ====== */
        if ($request->hasFile('media_files')) {
            foreach ($request->media_files as $file) {
                $path = $file->store('media', 'public');

                $content->media()->create([
                    'type'  => 'pdf',
                    'value' => $path,
                ]);
            }
        }

        return redirect()
            ->route('teacher.contents.index')
            ->with('success', 'Materi berhasil dibuat');
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
            'title' => 'required|string',
            'body' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'order' => 'required|integer',

            // multiple URL
            'media_urls.*' => 'nullable|string',

            // multiple PDF
            'media_files.*' => 'nullable|file|mimes:pdf',
        ]);

        $content->update([
            'title' => $request->title,
            'body'  => $request->body,
            'course_id' => $request->course_id,
            'order' => $request->order,
        ]);

        /* Tambah URL baru */
        if ($request->media_urls) {
            foreach ($request->media_urls as $url) {
                if ($url) {
                    $content->media()->create([
                        'type'  => $this->detectUrlType($url),
                        'value' => $url,
                    ]);
                }
            }
        }

        /* Tambah PDF baru */
        if ($request->hasFile('media_files')) {
            foreach ($request->media_files as $file) {
                $path = $file->store('media', 'public');
                $content->media()->create([
                    'type'  => 'pdf',
                    'value' => $path,
                ]);
            }
        }

        return back()->with('success', 'Materi berhasil diperbarui!');
    }


    public function deleteMedia($id)
    {
        $media = \App\Models\ContentMedia::findOrFail($id);

        if ($media->type === 'pdf_file') {
            if (\Storage::disk('public')->exists($media->value)) {
                \Storage::disk('public')->delete($media->value);
            }
        }

        $media->delete();

        return back()->with('success', 'Media berhasil dihapus.');
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

        return null;
    }



}
