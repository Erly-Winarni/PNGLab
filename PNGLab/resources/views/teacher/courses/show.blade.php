<x-app-layout>
    <x-slot name="header">
        {{-- Header akan diatur oleh Top Bar di app.blade.php. --}}
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Detail Course') }} 
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Main Card Container --}}
            <div class="bg-[#2f333a] p-6 md:p-8 rounded-xl shadow-xl border border-gray-700">
                
                {{-- Title and Back Button --}}
                <div class="flex justify-between items-start border-b border-gray-700 pb-4 mb-6">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight">{{ $course->name }}</h1>
                    
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('teacher.courses.index') }}" 
                       class="text-gray-400 hover:text-white transition flex items-center text-sm font-semibold">
                       <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                       Kembali
                    </a>
                </div>

                {{-- Description --}}
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-300 mb-2">Deskripsi Course</h3>
                    <p class="text-gray-400 leading-relaxed">{{ $course->description }}</p>
                </div>

                {{-- Metadata Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-gray-700 pt-6">
                    
                    {{-- Card 1: Category --}}
                    <div class="bg-[#20232a] p-4 rounded-lg border border-gray-600">
                        <p class="text-sm font-medium text-gray-500">Kategori</p>
                        <p class="mt-1 text-lg font-bold text-indigo-400">{{ $course->category->name }}</p>
                    </div>
                    
                    {{-- Card 2: Teacher --}}
                    <div class="bg-[#20232a] p-4 rounded-lg border border-gray-600">
                        <p class="text-sm font-medium text-gray-500">Pengajar</p>
                        <p class="mt-1 text-lg font-bold text-white">{{ $course->teacher->name }}</p>
                    </div>
                    
                    {{-- Card 3: Status --}}
                    <div class="bg-[#20232a] p-4 rounded-lg border border-gray-600">
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        
                        {{-- LOGIC DIBIARKAN SAMA --}}
                        <p class="mt-1 text-lg font-bold">
                            <span class="{{ $course->is_active ? 'text-green-500' : 'text-red-500' }}">
                                {{ $course->is_active ? 'Active (Publik)' : 'Inactive (Draft)' }}
                            </span>
                        </p>
                    </div>
                </div>
                
                {{-- Action Button (Contoh: Edit Course) --}}
                <div class="mt-8 pt-4 border-t border-gray-700 flex justify-end">
                    <a href="{{ route('teacher.courses.edit', $course->id) }}"
                       class="bg-yellow-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-yellow-700 transition">
                       Edit Course
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>