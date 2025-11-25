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
    /**
     * Tampilkan daftar semua kursus (Admin).
     */
    public function index()
    {
        $courses = Course::with('teacher', 'category')->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Form tambah kursus baru.
     */
    public function create()
    {
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.courses.create', compact('categories', 'teachers'));
    }

    /**
     * Simpan kursus baru.
     */
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
        ]);

        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['is_active'] = $request->has('is_active');

        Course::create($validatedData);

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Kursus baru berhasil dibuat oleh Admin.');
    }

    /**
     * Form edit kursus.
     */
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

    /**
     * Update kursus.
     */
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
        ]);

        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['is_active'] = $request->has('is_active');

        $course->update($validatedData);

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Kursus berhasil diperbarui secara global oleh Admin.');
    }

    /**
     * Hapus kursus.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
                         ->with('success', 'Kursus berhasil dihapus.');
    }

    /**
     * Tampilkan detail kursus (opsional jika dibutuhkan).
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }
}
