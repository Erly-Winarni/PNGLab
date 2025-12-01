<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 bg-white rounded-lg shadow-xl mt-8"> {{-- Tambahkan styling container --}}

        {{-- 1. HEADER & DESKRIPSI COURSE --}}
        <div class="mb-8 pb-4 border-b border-gray-200">
            <h1 class="text-4xl font-extrabold mb-2 text-[#193053]">{{ $course->title }}</h1>
            <p class="text-gray-600 mb-3">{{ $course->description }}</p>
            <p class="text-sm font-semibold text-[#446AA6]">Oleh: {{ $course->teacher->name }}</p>
        </div>

        {{-- 2. PROGRESS BAR COURSE --}}
        <h2 class="text-xl font-bold mb-3 text-[#193053]">Progress Pembelajaran</h2>
        <div class="mb-8">
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-[#52A397] h-3 rounded-full transition-all duration-500" style="width: {{ $course->progress }}%"></div>
            </div>
            <p class="text-sm font-medium mt-2 text-[#193053]">Selesai: <span class="font-bold">{{ $course->progress }}%</span></p>
        </div>

        <hr class="mb-8 border-gray-100">

        {{-- 3. LIST MATERI --}}
        <h2 class="text-2xl font-bold mb-4 text-[#193053]">Daftar Isi Materi</h2>
        <div class="space-y-4">
            @forelse($contents as $content)
                
                @php
                    // Logika untuk menentukan status styling
                    $isCompleted = $content->is_completed;
                    $bgColor = $isCompleted ? 'bg-[#EAF1FF]' : 'bg-gray-50';
                    $borderColor = $isCompleted ? 'border-[#446AA6]' : 'border-gray-200';
                @endphp

                <div class="p-4 rounded-xl shadow-sm border {{ $bgColor }} {{ $borderColor }} flex justify-between items-center transition duration-300 hover:shadow-md">
                    
                    <div class="flex items-center space-x-3">
                        
                        {{-- Icon Status --}}
                        <div class="text-xl {{ $isCompleted ? 'text-[#52A397]' : 'text-gray-400' }}">
                            @if($isCompleted)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @endif
                        </div>

                        {{-- Teks Materi --}}
                        <div>
                            <a href="{{ route('student.contents.show', [$course->slug, $content->id]) }}" class="block">
                                <h3 class="font-semibold text-lg {{ $isCompleted ? 'text-[#193053]' : 'text-gray-700' }} hover:text-[#446AA6] hover:underline transition">
                                    {{ $content->title }}
                                </h3>
                            </a>
                            <p class="text-gray-500 text-sm italic">{{ $content->description }}</p>
                        </div>
                    </div>

                    {{-- Tombol Aksi (Tandai Selesai / Mark Undone) --}}
                    <div>
                        @if($content->is_completed)
                            <form action="{{ route('student.contents.uncomplete', [$course->slug, $content->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-full text-sm hover:bg-yellow-600 transition shadow-md">
                                    ✅ Selesai
                                </button>
                            </form>
                        @else
                            <form action="{{ route('student.contents.complete', [$course->slug, $content->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-[#446AA6] text-white font-semibold rounded-full text-sm hover:bg-[#264069] transition shadow-md">
                                    Tandai Selesai
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 p-4 bg-gray-50 rounded-xl">Belum ada materi yang ditambahkan untuk course ini.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>