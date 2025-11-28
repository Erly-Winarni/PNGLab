<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">

        {{-- Judul --}}
        <h1 class="text-2xl font-bold mb-3">{{ $content->title }}</h1>

        {{-- Isi konten --}}
        <div class="prose mb-6">
            {!! nl2br(e($content->body)) !!}
        </div>

        {{-- PREVIEW MEDIA --}}
        @if ($content->media_type)

            {{-- YouTube --}}
            @if ($content->media_type === 'youtube')
                <iframe width="100%" height="400"
                    src="https://www.youtube.com/embed/{{ $content->getYoutubeId() }}"
                    frameborder="0" allowfullscreen></iframe>
            @endif

            {{-- External PDF --}}
            @if ($content->media_type === 'pdf')
                <embed src="{{ $content->media_url }}" type="application/pdf" width="100%" height="500" />
            @endif

            {{-- External DOC/DOCX (Google Docs Viewer) --}}
            @if (in_array($content->media_type, ['doc', 'docx']))
                <iframe src="https://docs.google.com/gview?url={{ $content->media_url }}&embedded=true"
                    style="width:100%; height:500px;" frameborder="0"></iframe>
            @endif

            {{-- Uploaded PDF --}}
            @if ($content->media_type === 'file_pdf')
                <embed src="{{ asset('storage/' . $content->media_path) }}" type="application/pdf"
                    width="100%" height="500" />
            @endif

            {{-- Uploaded DOC/DOCX --}}
            @if (in_array($content->media_type, ['file_doc', 'file_docx']))
                <iframe src="https://docs.google.com/gview?url={{ asset('storage/' . $content->media_path) }}&embedded=true"
                    style="width:100%; height:500px;" frameborder="0"></iframe>
            @endif

        @endif




        {{-- Jika konten sebelumnya belum selesai --}}
        @if (!$previousCompleted)
            <div class="p-3 bg-red-100 text-red-700 rounded mb-4">
                Selesaikan konten sebelumnya terlebih dahulu.
            </div>
        @endif


        {{-- Tombol Navigasi --}}
        <div class="flex items-center gap-3 mt-6">

            {{-- 🔙 Tombol kembali ke halaman course --}}
            <a href="{{ route('student.courses.show', $content->course->slug) }}"
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Kembali
            </a>

            @php
                $nextContent = $content->course->contents()
                    ->where('order', '>', $content->order)
                    ->orderBy('order', 'asc')
                    ->first();
            @endphp

            {{-- 🔜 Jika konten sebelumnya selesai dan ada materi berikutnya --}}
            @if ($previousCompleted && $nextContent)
                <a href="{{ route('student.contents.show', [$content->course->slug, $nextContent->id]) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Lanjut ke Materi Berikutnya →
                </a>
            @endif

        </div>

    </div>
</x-app-layout>
