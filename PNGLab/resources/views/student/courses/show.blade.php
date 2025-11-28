<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">{{ $course->title }}</h1>

        <p class="text-gray-600 mb-4">{{ $course->description }}</p>
        <p class="text-gray-500 mb-4">Teacher: {{ $course->teacher->name }}</p>

        {{-- Progress --}}
        <div class="mb-6">
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-green-500 h-4 rounded-full" style="width: {{ $course->progress }}%"></div>
            </div>
            <p class="text-sm mt-1">Progress: {{ $course->progress }}%</p>
        </div>

        {{-- List Materi --}}
        <h2 class="text-xl font-semibold mb-3">Materi</h2>
        <div class="space-y-3">
            @forelse($contents as $content)
                <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                    <div>
                        <a href="{{ route('student.contents.show', [$course->slug, $content->id]) }}">
                            <h3 class="font-semibold text-blue-600 hover:underline">
                                {{ $content->title }}
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm">{{ $content->description }}</p>
                    </div>

                        @if($content->is_completed)
                            <form action="{{ route('student.contents.uncomplete', [$course->slug, $content->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Mark Undone
                                </button>
                            </form>
                        @else
                            <form action="{{ route('student.contents.complete', [$course->slug, $content->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Tandai Selesai
                                </button>
                            </form>
                        @endif
                </div>
            @empty
                <p class="text-gray-500">Belum ada materi untuk course ini.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
