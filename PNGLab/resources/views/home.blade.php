@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-24">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di <span class="text-yellow-300">PNGLab</span></h1>
            <p class="text-lg opacity-90 mb-6">
                Platform kursus interaktif untuk belajar desain, editing, dan kreativitas digital.
            </p>

            <a href="{{ route('courses.index') }}"
                class="px-6 py-3 bg-yellow-400 text-gray-900 rounded-lg font-semibold hover:bg-yellow-300 transition">
                Jelajahi Kursus
            </a>
        </div>
    </section>

    <!-- Popular Courses -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-2xl font-bold mb-6">🔥 5 Kursus Terpopuler</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($popularCourses as $course)
                    <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="font-semibold text-lg">{{ $course->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ $course->description }}</p>

                        <p class="text-gray-500 text-xs">Teacher: {{ $course->teacher->name }}</p>

                        <a href="{{ route('courses.show', $course->id) }}"
                            class="mt-3 inline-block text-indigo-600 font-medium hover:underline">
                            Lihat Kursus →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Category Filter -->
    <section class="py-10 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-2xl font-bold mb-4">🎨 Telusuri Berdasarkan Kategori</h2>

            <div class="flex gap-3 flex-wrap">
                @foreach ($categories as $cat)
                    <a href="{{ route('courses.index', ['category' => $cat->id]) }}"
                        class="px-4 py-2 bg-white rounded-full shadow text-gray-700 hover:bg-indigo-500 hover:text-white transition">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
