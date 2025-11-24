<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary Card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Total Course</h3>
                    <p class="mt-2 text-3xl font-bold text-blue-600">{{ $courses->count() }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Total Student</h3>
                    <p class="mt-2 text-3xl font-bold text-green-600">{{ $totalStudents }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Course Aktif</h3>
                    <p class="mt-2 text-3xl font-bold text-purple-600">
                        {{ $courses->where('is_active', true)->count() }}
                    </p>
                </div>

            </div>

            {{-- Course List Section --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-700">Course Anda</h3>
                    <a href="{{ route('teacher.courses.create') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        + Buat Course Baru
                    </a>
                </div>

                @if ($courses->count() == 0)
                    <p class="text-gray-500">Anda belum membuat course apapun.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($courses as $course)
                            <div class="border p-4 rounded-lg flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-bold">{{ $course->title }}</h4>
                                    <p class="text-gray-600 text-sm">
                                        Kategori: {{ $course->category->name ?? 'Tidak ada kategori' }}
                                    </p>

                                    {{-- Student Count --}}
                                    <p class="text-gray-600 text-sm">
                                        {{ $course->students_count }} Student Terdaftar
                                    </p>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('teacher.courses.show', $course->slug) }}" 
                                        class="px-3 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                        Detail
                                    </a>
                                    <a href="{{ route('teacher.courses.edit', $course->id) }}" 
                                        class="px-3 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-xl font-semibold text-gray-700 mb-3">Akses Cepat</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('teacher.courses.index') }}" 
                       class="block bg-indigo-600 text-white py-3 rounded-lg text-center hover:bg-indigo-700">
                        Kelola Course
                    </a>

                    <a href="{{ route('teacher.contents.index') }}" 
                       class="block bg-green-600 text-white py-3 rounded-lg text-center hover:bg-green-700">
                       Kelola Content Materi
                    </a>

                    <a href="{{ route('profile.edit') }}"  
                       class="block bg-gray-800 text-white py-3 rounded-lg text-center hover:bg-gray-900">
                        Edit Profil
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
