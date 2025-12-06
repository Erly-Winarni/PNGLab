<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentMedia;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::where('teacher_id', auth()->id())->with('course')->paginate(10);
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
            'media_urls.*' => 'nullable|string',
            'media_files.*' => 'nullable|file|mimes:pdf',
            'order' => 'nullable|integer|min:0',
        ], [
            'title.required'       => 'Judul wajib diisi.',
            'title.string'         => 'Judul harus berupa teks.',
            'body.string'          => 'Konten harus berupa teks.',
            'course_id.required'   => 'Kursus wajib dipilih.',
            'course_id.exists'     => 'Kursus tidak valid.',
            'media_urls.*.string'  => 'URL media harus berupa teks.',
            'media_files.*.file'   => 'File media harus berupa file.',
            'media_files.*.mimes'  => 'File media harus berupa PDF.',
            'order.integer'        => 'Urutan harus berupa angka.',
            'order.min'            => 'Urutan minimal 0.',
        ]);

        $order = $request->order ?? 0;

        Content::where('course_id', $request->course_id)
            ->where('order', '>=', $order)
            ->increment('order');

        $content = Content::create([
            'title' => $request->title,
            'body' => $request->body,
            'course_id' => $request->course_id,
            'teacher_id' => auth()->id(),
            'order' => $order,
        ]);

        if ($request->media_urls) {
            foreach ($request->media_urls as $url) {
                if ($url) {
                    $content->media()->create([
                        'type' => $this->detectUrlType($url),
                        'value' => $url,
                    ]);
                }
            }
        }

        if ($request->hasFile('media_files')) {
            foreach ($request->media_files as $file) {
                $path = $file->store('media', 'public');
                $content->media()->create([
                    'type' => 'pdf',
                    'value' => $path,
                ]);
            }
        }

        return redirect()->route('teacher.contents.index')
                         ->with('success', 'Materi berhasil dibuat.');
    }

    public function edit(Content $content)
    {
        if ($content->teacher_id !== auth()->id()) abort(403);

        $courses = Course::where('teacher_id', auth()->id())->get();
        return view('teacher.contents.edit', compact('content', 'courses'));
    }

    public function update(Request $request, Content $content)
    {
        if ($content->teacher_id !== auth()->id()) abort(403);

        $request->validate([
            'title' => 'required|string',
            'body' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'media_urls.*' => 'nullable|string',
            'media_files.*' => 'nullable|file|mimes:pdf',
            'order' => 'nullable|integer|min:0',
        ], [
            'title.required'       => 'Judul wajib diisi.',
            'title.string'         => 'Judul harus berupa teks.',
            'body.string'          => 'Konten harus berupa teks.',
            'course_id.required'   => 'Kursus wajib dipilih.',
            'course_id.exists'     => 'Kursus tidak valid.',
            'media_urls.*.string'  => 'URL media harus berupa teks.',
            'media_files.*.file'   => 'File media harus berupa file.',
            'media_files.*.mimes'  => 'File media harus berupa PDF.',
            'order.integer'        => 'Urutan harus berupa angka.',
            'order.min'            => 'Urutan minimal 0.',
        ]);

        if ($request->filled('order')) {
            $finalOrder = $request->order;
        } else {
            $finalOrder = Content::where('course_id', $request->course_id)->max('order') + 1;
        }

        $content->update([
            'title' => $request->title,
            'body' => $request->body,
            'course_id' => $request->course_id,
            'order' => $finalOrder,
        ]);

        if ($request->media_urls) {
            foreach ($request->media_urls as $url) {
                if ($url) {
                    $content->media()->create([
                        'type' => $this->detectUrlType($url),
                        'value' => $url,
                    ]);
                }
            }
        }

        if ($request->hasFile('media_files')) {
            foreach ($request->media_files as $file) {
                $path = $file->store('media', 'public');
                $content->media()->create([
                    'type' => 'pdf',
                    'value' => $path,
                ]);
            }
        }

        return redirect()->route('teacher.contents.index')
                         ->with('success', 'Materi berhasil diperbarui.');
    }

    public function manageMedia($contentId)
    {
        $content = Content::with('media')->where('teacher_id', auth()->id())->findOrFail($contentId);
        return view('teacher.contents.media', compact('content'));
    }

    public function deleteMedia($mediaId)
    {
        $media = ContentMedia::findOrFail($mediaId);

        if ($media->type === 'pdf' && Storage::disk('public')->exists($media->value)) {
            Storage::disk('public')->delete($media->value);
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

        if (preg_match('/youtu\.be|youtube\.com/', $url)) {
            return 'youtube';
        }

        if (str_ends_with($url, '.pdf')) {
            return 'pdf';
        }

        return null;
    }

}
