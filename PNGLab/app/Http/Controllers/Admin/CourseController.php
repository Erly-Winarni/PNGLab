<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category; // Diperlukan untuk form
use App\Models\User;     // Diperlukan untuk memilih Guru
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Diperlukan untuk pembuatan slug

class CourseController extends Controller
{
    /**
     * Menampilkan daftar semua kursus untuk Admin.
     */
    public function index()
    {
        // Admin melihat SEMUA kursus dengan eager loading guru (teacher)
        $courses = Course::with('teacher')->paginate(20); 
        return view('admin.courses.index', compact('courses'));
    }

    // -------------------------------------------------------------
    // 🔥 METHOD BARU: CREATE
    // -------------------------------------------------------------
    /**
     * Tampilkan formulir untuk membuat kursus baru (oleh Admin).
     */
    public function create()
    {
        // Admin perlu memilih Kategori dan Guru untuk kursus ini
        $categories = Category::all();
        // Ambil hanya user dengan role 'teacher'
        $teachers = User::where('role', 'teacher')->get(); 
        
        return view('admin.courses.create', compact('categories', 'teachers'));
    }

    // -------------------------------------------------------------
    // 🔥 METHOD BARU: STORE
    // -------------------------------------------------------------
    /**
     * Menyimpan kursus yang baru dibuat oleh Admin.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Title harus unik
            'title'        => 'required|unique:courses,title|max:255', 
            'description'  => 'required',
            // Admin HARUS memilih Guru (teacher_id)
            'teacher_id'   => 'required|exists:users,id', 
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'category_id'  => 'nullable|exists:categories,id',
            'is_active'    => 'nullable|boolean', 
            'max_students' => 'nullable|integer|min:1',
        ]);
        
        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['is_active'] = $request->has('is_active');
        
        Course::create($validatedData);

        return redirect()->route('admin.courses.index')
                         ->with('success', 'Kursus baru berhasil dibuat oleh Admin.');
    }
    
    // -------------------------------------------------------------
    // METHOD YANG DIPERBAIKI: EDIT
    // -------------------------------------------------------------
    /**
     * Tampilkan formulir untuk mengedit kursus apa pun.
     */
    public function edit(Course $course)
    {
        // Admin perlu daftar Kategori dan daftar Guru (Teachers)
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get(); 
        
        return view('admin.courses.edit', [
            'course' => $course,
            'categories' => $categories, 
            'teachers' => $teachers, // 🔥 Ditambahkan: Admin bisa mengganti teacher
        ]);
    }
    
    // -------------------------------------------------------------
    // METHOD YANG DIPERBAIKI: UPDATE
    // -------------------------------------------------------------
    /**
     * Memperbarui kursus yang ditentukan oleh Admin.
     */
    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            // Title unik, tetapi dikecualikan untuk ID kursus saat ini
            'title'        => 'required|max:255|unique:courses,title,' . $course->id, 
            'description'  => 'required',
            // 🔥 Diperbaiki: Admin bisa mengubah Teacher
            'teacher_id'   => 'required|exists:users,id', 
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'category_id'  => 'nullable|exists:categories,id',
            'is_active'    => 'nullable|boolean', 
            'max_students' => 'nullable|integer|min:1',
        ]);
        
        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['is_active'] = $request->has('is_active');
        
        $course->update($validatedData);

        return redirect()->route('admin.courses.index')
                         ->with('success', 'Kursus berhasil diperbarui secara global oleh Admin.');
    }

    /**
     * Hapus kursus yang ditentukan oleh Admin.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')
                         ->with('success', 'Kursus berhasil dihapus oleh Admin.');
    }

    
}