<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('teacher_id', auth()->id())->paginate(10);
        return view('teacher.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('teacher.courses.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'description'  => 'required',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'category_id'  => 'nullable|exists:categories,id',
        ], [
            'title.required'        => 'Judul wajib diisi.',
            'description.required'  => 'Deskripsi wajib diisi.',
            'start_date.required'   => 'Tanggal mulai wajib diisi.',
            'start_date.date'       => 'Tanggal mulai tidak valid.',
            'end_date.required'     => 'Tanggal selesai wajib diisi.',
            'end_date.date'         => 'Tanggal selesai tidak valid.',
            'end_date.after_or_equal'=> 'Tanggal selesai harus sama atau setelah tanggal mulai.',
            'category_id.exists'    => 'Kategori tidak valid.',
        ]);


        Course::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'teacher_id'  => auth()->id(),
            'category_id' => $request->category_id,
            'is_active'   => $request->has('is_active'),
            'max_students' => $request->max_students,
        ]);

        return redirect()->route('teacher.dashboard')
            ->with('success', 'Course berhasil dibuat.');
    }

    public function edit(Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        return view('teacher.courses.edit', [
            'course'     => $course,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title'        => 'required',
            'description'  => 'required',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'category_id'  => 'nullable|exists:categories,id',
        ], [
            'title.required'        => 'Judul wajib diisi.',
            'description.required'  => 'Deskripsi wajib diisi.',
            'start_date.required'   => 'Tanggal mulai wajib diisi.',
            'start_date.date'       => 'Tanggal mulai tidak valid.',
            'end_date.required'     => 'Tanggal selesai wajib diisi.',
            'end_date.date'         => 'Tanggal selesai tidak valid.',
            'end_date.after_or_equal'=> 'Tanggal selesai harus sama atau setelah tanggal mulai.',
            'category_id.exists'    => 'Kategori tidak valid.',
        ]);

        $course->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'category_id' => $request->category_id,
            'is_active'   => $request->has('is_active'),
            'max_students' => $request->max_students,
        ]);

        return redirect()->route('teacher.dashboard')
            ->with('success', 'Course berhasil diperbarui.');
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->with(['contents', 'category', 'teacher'])
            ->firstOrFail();

        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $students = $course->students()
                           ->orderBy('name')
                           ->paginate(5);
        
        return view('teacher.courses.show', compact('course', 'students'));
    }


    public function destroy(Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $course->delete();

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course berhasil dihapus.');
    }
}
