<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Dashboard Student</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <h3 class="font-bold text-lg">Course Tersedia</h3>
        <ul class="space-y-2">
            @foreach($courses as $course)
                <li class="border p-3 rounded flex justify-between items-center">
                    <div>{{ $course->title }}</div>
                    <a href="{{ route('student.courses.show', $course->slug) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Lihat Materi</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
