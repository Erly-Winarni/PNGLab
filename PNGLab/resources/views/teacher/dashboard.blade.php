<x-app-layout>
    <x-slot name="header">
        {{-- Header akan diatur oleh Top Bar di app.blade.php. --}}
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Teacher Dashboard') }} 👋
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- ===================== --}}
            {{-- 1. Summary Cards (Statistik) --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Card 1: Total Course --}}
                <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700 hover:scale-[1.02] transition duration-300" 
                     style="background: linear-gradient(135deg, #1e3a8a, #1d4ed8);">
                    <h3 class="text-lg font-semibold text-blue-200 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.206 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.794 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.794 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.206 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                        Total Course
                    </h3>
                    {{-- LOGIC DIBIARKAN SAMA --}}
                    <p class="mt-3 text-4xl font-extrabold text-white">{{ $courses->count() }}</p>
                </div>

                {{-- Card 2: Total Student --}}
                <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700 hover:scale-[1.02] transition duration-300"
                     style="background: linear-gradient(135deg, #057a55, #046c4e);">
                    <h3 class="text-lg font-semibold text-green-200 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.656-.126-1.283-.356-1.857M9 20H4v-2a3 3 0 015-2.236M9 20v-2c0-.656-.126-1.283-.356-1.857m3-2.236a1 1 0 100-2 1 1 0 000 2zm1-10a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Total Student
                    </h3>
                    {{-- LOGIC DIBIARKAN SAMA --}}
                    <p class="mt-3 text-4xl font-extrabold text-white">{{ $totalStudents }}</p>
                </div>

                {{-- Card 3: Course Aktif --}}
                <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700 hover:scale-[1.02] transition duration-300"
                     style="background: linear-gradient(135deg, #7e22ce, #9333ea);">
                    <h3 class="text-lg font-semibold text-purple-200 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.233a10.975 10.975 0 010 16.466m-1.396-1.396a8 8 0 000-12.732m-7.396 7.396a4 4 0 11-5.656 5.656m5.656-5.656z"></path></svg>
                        Course Aktif
                    </h3>
                    {{-- LOGIC DIBIARKAN SAMA --}}
                    <p class="mt-3 text-4xl font-extrabold text-white">
                        {{ $courses->where('is_active', true)->count() }}
                    </p>
                </div>

            </div>

            {{-- ===================== --}}
            {{-- 2. Course List Section --}}
            {{-- ===================== --}}
            <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700">
                <div class="flex justify-between items-center mb-6 border-b border-gray-700 pb-4">
                    <h3 class="text-2xl font-bold text-white">Course Anda</h3>
                    <a href="{{ route('teacher.courses.create') }}" 
                        class="bg-blue-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-blue-700 transition flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Buat Course Baru
                    </a>
                </div>

                @if ($courses->count() == 0)
                    <p class="text-gray-400 py-4">Anda belum membuat course apapun. Klik tombol di atas untuk memulai!</p>
                @else
                    <div class="space-y-4">
                        @foreach ($courses as $course)
                            <div class="bg-[#20232a] p-5 rounded-lg flex flex-col md:flex-row justify-between items-start md:items-center 
                                        border border-gray-600 hover:border-blue-500 transition duration-200">
                                
                                {{-- Course Info --}}
                                <div class="mb-3 md:mb-0">
                                    <h4 class="text-xl font-extrabold text-white">{{ $course->title }}</h4>
                                    
                                    {{-- Category --}}
                                    <p class="text-gray-400 text-sm mt-1">
                                        <span class="font-medium">Kategori:</span> 
                                        {{ $course->category->name ?? 'Tidak ada kategori' }}
                                    </p>

                                    {{-- Status dan Student Count --}}
                                    <div class="flex items-center gap-4 mt-2 text-sm">
                                        <p class="text-gray-400">
                                            <span class="font-bold text-lg text-green-400">{{ $course->students_count }}</span> Student
                                        </p>
                                        
                                        {{-- Status Aktif/Tidak Aktif --}}
                                        @if ($course->is_active)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-300">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-900 text-red-300">
                                                Draft
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="flex gap-3 pt-3 md:pt-0">
                                    <a href="{{ route('teacher.courses.show', $course->slug) }}" 
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-semibold">
                                        Lihat Materi
                                    </a>
                                    <a href="{{ route('teacher.courses.edit', $course->id) }}" 
                                        class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition text-sm font-semibold">
                                        Edit Course
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ===================== --}}
            {{-- 3. Quick Actions --}}
            {{-- ===================== --}}
            <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700">
                <h3 class="text-2xl font-bold text-white mb-4 border-b border-gray-700 pb-3">Akses Cepat</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    
                    {{-- Kelola Course --}}
                    <a href="{{ route('teacher.courses.index') }}" 
                        class="block py-4 rounded-lg text-center font-bold text-lg 
                               bg-gradient-to-r from-indigo-600 to-blue-600 text-white 
                               hover:from-indigo-700 hover:to-blue-700 transition shadow-lg">
                        Kelola Course
                    </a>

                    {{-- Kelola Content Materi --}}
                    <a href="{{ route('teacher.contents.index') }}" 
                        class="block py-4 rounded-lg text-center font-bold text-lg 
                               bg-gradient-to-r from-green-600 to-teal-600 text-white 
                               hover:from-green-700 hover:to-teal-700 transition shadow-lg">
                        Kelola Content Materi
                    </a>

                    {{-- Edit Profil --}}
                    <a href="{{ route('profile.edit') }}"  
                        class="block py-4 rounded-lg text-center font-bold text-lg 
                               bg-gradient-to-r from-gray-700 to-gray-900 text-white 
                               hover:from-gray-800 hover:to-gray-900 transition shadow-lg">
                        Edit Profil
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>