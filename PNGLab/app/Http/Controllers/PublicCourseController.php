<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PublicCourseController extends Controller
{
    // 🔥 Pindahkan logika tampil kursus publik ke sini
    public function show($slug)
    {
        // Tetap menggunakan firstOrFail() untuk melempar 404 jika slug tidak ditemukan
        $course = Course::where('slug', $slug)->firstOrFail(); 
        return view('courses.show', compact('course'));
    }
    
    // Anda juga bisa menambahkan method index() untuk menampilkan katalog semua kursus
    // public function index() { ... }
}