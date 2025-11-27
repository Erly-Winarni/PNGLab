<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Course Catalog</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="font-semibold text-lg">{{ $course->title }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $course->description }}</p>
                    <p class="text-gray-500 text-xs mb-2">
                        Teacher: {{ $course->teacher->name }}
                    </p>

                    {{-- Progress --}}
                    @if($course->is_followed)
                        <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                            <div class="bg-green-500 h-3 rounded-full" style="width: {{ $course->progress }}%"></div>
                        </div>
                        <p class="text-sm mb-2">Progress: {{ $course->progress }}%</p>
                    @endif

                    <div class="flex gap-2">
                        {{-- Hubungi Teacher --}}
                        <a href="mailto:{{ $course->teacher->email }}?subject=Pertanyaan tentang {{ $course->title }}"
                           class="flex-1 text-center px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Hubungi Teacher
                        </a>

                        {{-- Follow Course --}}
                        @unless($course->is_followed)
                            <form action="{{ route('student.courses.follow', $course) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                    Ikuti Course
                                </button>
                            </form>
                        @endunless
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
