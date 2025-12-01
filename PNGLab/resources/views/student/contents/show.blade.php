<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4"> {{-- Gunakan max-w-4xl agar konten lebih lebar --}}

        {{-- 1. HEADER MATERI & STATUS --}}
        <div class="mb-8 border-b pb-4 border-gray-200">
            <a href="{{ route('student.courses.show', $content->course->slug) }}"
                class="text-sm font-semibold text-[#446AA6] hover:text-[#264069] transition flex items-center">
                ← Kembali ke Daftar Materi {{ $content->course->title }}
            </a>
            
            <h1 class="text-3xl font-extrabold mt-2 text-[#193053]">{{ $content->title }}</h1>
        </div>

        {{-- 2. ALERT KONDISIONAL (TETAPKAN LOGIKA LAMA) --}}
        @if (!$previousCompleted)
            <div class="flex items-center p-4 mb-6 bg-red-100 text-red-700 border-l-4 border-red-500 rounded-lg shadow-sm">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.55 2.503-1.55 3.268 0l7.556 15.385c.765 1.55-.373 3.266-1.884 3.266H2.585c-1.511 0-2.649-1.716-1.884-3.266l7.556-15.385zM9 14h2v2H9v-2zm0-4h2v4H9v-4z" clip-rule="evenodd"></path></svg>
                <p class="font-medium">⚠️ Selesaikan materi sebelumnya terlebih dahulu.</p>
            </div>
        @endif

        {{-- 3. ISI KONTEN (Teks & Media) --}}
        <div class="bg-white p-6 rounded-2xl shadow-xl space-y-6">
            
            {{-- Isi Konten Teks --}}
            <div class="prose max-w-none text-[#193053]">
                {!! nl2br(e($content->body)) !!}
            </div>

            {{-- PREVIEW MULTI MEDIA --}}
            @if ($content->media->count())
                <div class="space-y-8 pt-4 border-t border-gray-100">

                    @foreach ($content->media as $m)

                        {{-- ================= YOUTUBE ================= --}}
                        @if ($m->type === 'youtube')
                            @php
                                $id = null;
                                if (str_contains($m->value, 'youtu.be')) {
                                    $id = Str::after($m->value, 'youtu.be/');
                                } elseif (str_contains($m->value, 'watch?v=')) {
                                    $id = Str::after($m->value, 'v=');
                                    $id = Str::before($id, '&'); // hapus parameter
                                }
                            @endphp

                            @if ($id)
                                <div class="relative overflow-hidden rounded-xl shadow-lg" style="padding-top: 56.25%"> 
                                    <iframe class="absolute top-0 left-0 w-full h-full"
                                        src="https://www.youtube.com/embed/{{ $id }}"
                                        frameborder="0" allowfullscreen>
                                    </iframe>
                                </div>
                            @endif
                        @endif


                        {{-- ================= PDF PREVIEW ================= --}}
                        @if ($m->type === 'pdf')
                            <div class="border border-gray-300 rounded-xl overflow-hidden shadow-lg">
                                @php
                                    $src = Str::startsWith($m->value, 'http') ? $m->value : asset('storage/' . $m->value);
                                @endphp
                                <embed src="{{ $src }}" type="application/pdf"
                                    width="100%" height="600"
                                    class="w-full"/>
                            </div>
                        @endif

                    @endforeach

                </div>
            @endif
        </div>

        {{-- 4. FOOTER NAVIGASI --}}
        <div class="flex justify-between items-center gap-4 mt-8">

            {{-- Tombol Kembali ke Course --}}
            <a href="{{ route('student.courses.show', $content->course->slug) }}"
                class="flex items-center px-6 py-3 bg-gray-200 text-[#193053] rounded-full font-semibold hover:bg-gray-300 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
                Daftar Isi
            </a>

            @php
                $nextContent = $content->course->contents()
                    ->where('order', '>', $content->order)
                    ->orderBy('order', 'asc')
                    ->first();
            @endphp

            {{-- Tombol Lanjut ke Materi Berikutnya --}}
            @if ($previousCompleted && $nextContent)
                <a href="{{ route('student.contents.show', [$content->course->slug, $nextContent->id]) }}"
                    class="flex items-center px-6 py-3 bg-[#446AA6] text-white rounded-full font-bold hover:bg-[#264069] transition">
                    Lanjut Materi
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            @else
                <button disabled class="px-6 py-3 bg-gray-400 text-white rounded-full font-bold cursor-not-allowed opacity-70">
                    Lanjut Materi →
                </button>
            @endif

        </div>

    </div>
</x-app-layout>