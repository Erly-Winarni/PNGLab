<x-app-layout>

    <div class="max-w-6xl mx-auto p-6">

        {{-- Header --}}
        <h1 class="text-3xl font-bold mb-2">Dashboard Student</h1>
        <p class="text-gray-600 mb-8">
            Halo {{ auth()->user()->name }}, lanjutkan pembelajaranmu di PNGLab.
        </p>


        {{-- Courses yang diikuti --}}
        <h2 class="text-xl font-semibold mb-4">Kursus yang Sedang Kamu Ikuti</h2>

        @if ($courses->count() == 0)
            <p class="text-gray-600">Kamu belum mengikuti kursus apapun.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach ($courses as $course)
                    <div class="bg-white rounded-xl shadow p-5 border">

                        {{-- Judul Kursus --}}
                        <h3 class="text-lg font-bold">
                            {{ $course->title }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-3">
                            Kategori: {{ $course->category->name }}
                        </p>

                        {{-- Progress --}}
                        <div class="mb-3">
                            <div class="w-full bg-gray-200 h-3 rounded-full">
                                <div class="h-3 bg-indigo-600 rounded-full"
                                     style="width: {{ $course->progress }}%">
                                </div>
                            </div>

                            <p class="text-sm text-gray-700 mt-1">
                                Progress: <b>{{ $course->progress }}%</b>
                                ({{ $course->contents->whereIn('id', $course->contents->pluck('id'))->count() }} selesai /
                                {{ $course->contents_count }} konten)
                            </p>
                        </div>

                        {{-- Tombol --}}
                        <a href="{{ route('courses.show', $course->slug) }}"
                           class="inline-block mt-3 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">
                            Lanjutkan Belajar
                        </a>

                    </div>
                @endforeach

            </div>
        @endif



        {{-- Rekomendasi --}}
        <h2 class="text-xl font-semibold mt-10 mb-4">Rekomendasi untuk Kamu</h2>

        @if ($recommendations->count() == 0)
            <p class="text-gray-600">Belum ada rekomendasi kursus.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

                @foreach ($recommendations as $course)
                    <div class="bg-white rounded-xl border shadow p-4">
                        <h3 class="font-semibold text-lg">{{ $course->title }}</h3>

                        <p class="text-sm text-gray-500 mb-3">
                            {{ Str::limit($course->description, 80) }}
                        </p>

                        <a href="{{ route('courses.show', $course->slug) }}"
                           class="text-indigo-600 font-semibold hover:underline">
                            Lihat Kursus
                        </a>
                    </div>
                @endforeach

            </div>
        @endif

    </div>

</x-app-layout>
