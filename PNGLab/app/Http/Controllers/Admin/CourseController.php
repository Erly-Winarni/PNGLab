<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher', 'category')->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.courses.create', compact('categories', 'teachers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'        => 'required|unique:courses,title|max:255',
            'description'  => 'required',
            'teacher_id'   => 'required|exists:users,id',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'category_id'  => 'nullable|exists:categories,id',
            'max_students' => 'nullable|integer|min:1',
        ], [
            'title.required'         => 'Judul wajib diisi.',
            'title.max'              => 'Judul maksimal 255 karakter.',
            'title.unique'           => 'Judul sudah digunakan.',
            'description.required'   => 'Deskripsi wajib diisi.',
            'teacher_id.required'    => 'Guru wajib dipilih.',
            'teacher_id.exists'      => 'Guru tidak valid.',
            'start_date.required'    => 'Tanggal mulai wajib diisi.',
            'start_date.date'        => 'Tanggal mulai tidak valid.',
            'end_date.required'      => 'Tanggal selesai wajib diisi.',
            'end_date.date'          => 'Tanggal selesai tidak valid.',
            'end_date.after_or_equal'=> 'Tanggal selesai harus sama atau setelah tanggal mulai.',
            'category_id.exists'     => 'Kategori tidak valid.',
            'max_students.integer'   => 'Maksimal siswa harus berupa angka.',
            'max_students.min'       => 'Maksimal siswa minimal 1.',
            'max_students.required'  => 'Maksimal siswa wajib diisi jika ingin diatur.',
        ]);

        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['is_active'] = $request->has('is_active');

        Course::create($validatedData);

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Kursus baru berhasil dibuat oleh Admin.');
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.courses.edit', [
            'course'     => $course,
            'categories' => $categories,
            'teachers'   => $teachers,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title'        => 'required|max:255|unique:courses,title,' . $course->id,
            'description'  => 'required',
            'teacher_id'   => 'required|exists:users,id',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'category_id'  => 'nullable|exists:categories,id',
            'max_students' => 'nullable|integer|min:1',
        ], [
            'title.required'         => 'Judul wajib diisi.',
            'title.max'              => 'Judul maksimal 255 karakter.',
            'title.unique'           => 'Judul sudah digunakan.',
            'description.required'   => 'Deskripsi wajib diisi.',
            'teacher_id.required'    => 'Guru wajib dipilih.',
            'teacher_id.exists'      => 'Guru tidak valid.',
            'start_date.required'    => 'Tanggal mulai wajib diisi.',
            'start_date.date'        => 'Tanggal mulai tidak valid.',
            'end_date.required'      => 'Tanggal selesai wajib diisi.',
            'end_date.date'          => 'Tanggal selesai tidak valid.',
            'end_date.after_or_equal'=> 'Tanggal selesai harus sama atau setelah tanggal mulai.',
            'category_id.exists'     => 'Kategori tidak valid.',
            'max_students.integer'   => 'Maksimal siswa harus berupa angka.',
            'max_students.min'       => 'Maksimal siswa minimal 1.',
            'max_students.required'  => 'Maksimal siswa wajib diisi jika ingin diatur.',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['is_active'] = $request->has('is_active');

        $course->update($validatedData);

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Kursus berhasil diperbarui secara global oleh Admin.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
                         ->with('success', 'Kursus berhasil dihapus.');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }
}
