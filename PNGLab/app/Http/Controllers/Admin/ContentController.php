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
            'title'       => 'required|string',
            'body'        => 'nullable|string',
            'course_id'   => 'required|exists:courses,id',
            'media_urls.*' => 'nullable|string',
            'media_files.*' => 'nullable|file|mimes:pdf',
            'order' => 'nullable|integer|min:0',
        ]);

        $course = Course::findOrFail($request->course_id);

        if (!$course->teacher_id) {
            return back()->withErrors([
                'course_id' => 'Course ini belum memiliki guru.'
            ])->withInput();
        }

        $content = Content::create([
            'title'      => $request->title,
            'body'       => $request->body,
            'course_id'  => $request->course_id,
            'teacher_id' => $course->teacher_id, 
            'order'      => $request->order ?? 0,
        ]);

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

        if ($request->hasFile('media_files')) {
            foreach ($request->media_files as $file) {
                $path = $file->store('media', 'public');

                $content->media()->create([
                    'type'  => 'pdf',
                    'value' => $path,
                ]);
            }
        }

        return redirect()->route('admin.contents.index')
            ->with('success','Materi berhasil dibuat.');
    }


    public function edit(Content $content)
    {
        $courses = Course::all();
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.contents.edit', compact('content', 'courses', 'teachers'));
    }

    public function update(Request $request, Content $content)
    {
        $course = Course::findOrFail($request->course_id);

        $request->validate([
            'title'       => 'required|string',
            'body'        => 'nullable|string',
            'course_id'   => 'required|exists:courses,id',
            'media_urls.*' => 'nullable|string',
            'media_files.*' => 'nullable|file|mimes:pdf',
            'order' => 'nullable|integer|min:0',
        ]);

        $updateData = [
            'title'      => $request->title,
            'body'       => $request->body,
            'course_id'  => $request->course_id,
            'order'      => $request->order ?? 0,
        ];

        if ($content->course_id != $request->course_id) {
            $updateData['teacher_id'] = $course->teacher_id;
        }

        $content->update($updateData);

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

        if ($request->hasFile('media_files')) {
            foreach ($request->media_files as $file) {
                $path = $file->store('media', 'public');

                $content->media()->create([
                    'type'  => 'pdf',
                    'value' => $path,
                ]);
            }
        }

        return redirect()->route('admin.contents.index')
                 ->with('success','Materi berhasil diperbarui.');

    }

    public function deleteMedia($mediaId)
    {
        $media = \App\Models\ContentMedia::findOrFail($mediaId);

        if ($media->type === 'pdf') {
            if (\Storage::exists($media->value)) {
                \Storage::delete($media->value);
            }
        }

        $media->delete();

        return back()->with('success', 'Media berhasil dihapus.');
    }

    public function manageMedia($contentId)
    {
        $content = Content::with('media')->findOrFail($contentId);

        return view('admin.contents.media', compact('content'));
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return redirect()->route('admin.contents.index')
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
