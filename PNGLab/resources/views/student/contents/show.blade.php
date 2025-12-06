<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4"> 
        <div class="mb-8 border-b pb-4 border-gray-200">
            <h1 class="text-3xl font-extrabold mt-2 text-[#193053]">{{ $content->title }}</h1>
        </div>

        <div class="mt-6">
            @php
                $isCompleted = auth()->user()
                    ->contentProgress()
                    ->where('content_id', $content->id)
                    ->where('is_done', true)
                    ->exists();
            @endphp

            <div class="flex items-center mb-5">
                @if (!$isCompleted)
                    <form method="POST"
                        action="{{ route('student.contents.complete', [$content->course->slug, $content->id]) }}">
                        @csrf
                        <button class="flex items-center gap-2 px-4 py-3 bg-[#446AA6] text-white font-semibold rounded-full text-md hover:bg-[#264069] transition shadow-md">
                            <span>Selesai</span>
                        </button>
                    </form>
                @else
                    <form method="POST"
                        action="{{ route('student.contents.uncomplete', [$content->course->slug, $content->id]) }}">
                        @csrf
                        <button class="flex items-center gap-2 px-4 py-3 bg-[#F4A03E] text-white font-semibold rounded-full text-md hover:bg-yellow-600 transition shadow-md">
                            <span>Selesai (Tandai Batal)</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        @if (!$previousCompleted)
            <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
                <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-lg text-center">
                    <img src="{{ asset('images/icon-warning.png') }}" class="mx-auto mb-4 w-16">
                    <h2 class="text-2xl font-bold text-red-600 mb-4">Akses Terkunci</h2>
                    <p class="text-lg text-gray-700">
                        Selesaikan materi sebelumnya terlebih dahulu untuk membuka materi ini.
                    </p>
                    <a href="{{ route('student.courses.show', $content->course->slug) }}"
                    class="mt-6 inline-block bg-[#446AA6] text-white px-6 py-3 rounded-full font-semibold hover:bg-[#264069] transition">
                        Kembali ke Daftar Isi
                    </a>
                </div>
            </div>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-xl space-y-6 {{ !$previousCompleted ? 'blur-sm pointer-events-none select-none opacity-30' : '' }}">
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