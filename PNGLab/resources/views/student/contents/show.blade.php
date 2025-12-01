<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4"> 
        <div class="mb-8 border-b pb-4 border-gray-200">
            <h1 class="text-3xl font-extrabold mt-2 text-[#193053]">{{ $content->title }}</h1>
        </div>

        @if (!$previousCompleted)
            <div class="flex items-center p-4 mb-6 bg-red-100 text-red-700 border-l-4 border-red-500 rounded-lg shadow-sm">
                <img src="{{ asset('images/icon-warning.png') }}" alt="Ikon Warning" class="h-6 w-6 object-contain">
                <p class="font-medium">Selesaikan materi sebelumnya terlebih dahulu.</p>
            </div>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-xl space-y-6">
            <div class="prose max-w-none text-[#193053]">
                {!! nl2br(e($content->body)) !!}
            </div>

            @if ($content->media->count())
                <div class="space-y-8 pt-4 border-t border-gray-100">

                    @foreach ($content->media as $m)
                        @if ($m->type === 'youtube')
                            @php
                                $id = null;
                                if (str_contains($m->value, 'youtu.be')) {
                                    $id = Str::after($m->value, 'youtu.be/');
                                } elseif (str_contains($m->value, 'watch?v=')) {
                                    $id = Str::after($m->value, 'v=');
                                    $id = Str::before($id, '&'); 
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

        <div class="flex justify-between items-center gap-4 mt-8">

            <a href="{{ route('student.courses.show', $content->course->slug) }}"
                class="flex items-center px-6 py-3 bg-gray-200 text-[#193053] rounded-full font-semibold hover:bg-gray-300 transition">
                < Daftar Isi
            </a>

            @php
                $nextContent = $content->course->contents()
                    ->where('order', '>', $content->order)
                    ->orderBy('order', 'asc')
                    ->first();
            @endphp

            @if ($previousCompleted && $nextContent)
                <a href="{{ route('student.contents.show', [$content->course->slug, $nextContent->id]) }}"
                    class="flex items-center px-6 py-3 bg-[#446AA6] text-white rounded-full font-bold hover:bg-[#264069] transition">
                    Lanjut Materi >
                </a>
            @else
                <button disabled class="px-6 py-3 bg-gray-400 text-white rounded-full font-bold cursor-not-allowed opacity-70">
                    Lanjut Materi >
                </button>
            @endif

        </div>

    </div>
</x-app-layout>