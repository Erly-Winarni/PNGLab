@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">

    <h1 class="text-3xl font-bold mb-2">{{ $course->name }}</h1>

    <p class="text-gray-600">{{ $course->description }}</p>

    <p class="mt-2 text-sm text-gray-500">Teacher: {{ $course->teacher->name }}</p>

    <div class="mt-6">
        @auth
            @if(auth()->user()->role == 'student')
                @if(!auth()->user()->isEnrolled($course->id))
                    <form method="POST" action="{{ route('courses.enroll', $course->id) }}">
                        @csrf
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Ikuti Kursus</button>
                    </form>
                @else
                    <div class="bg-green-100 text-green-700 p-3 rounded">
                        Kamu sudah mengikuti kursus ini.
                    </div>
                @endif
            @endif
        @endauth
    </div>

    <hr class="my-8">

    <h2 class="text-xl font-semibold mb-4">Materi Pembelajaran</h2>

    @foreach ($course->contents as $content)
        <div class="p-4 border rounded-lg mb-4 bg-white">
            <h3 class="font-bold">{{ $content->title }}</h3>

            <a href="{{ route('lessons.show', [$course->id, $content->id]) }}"
                class="mt-2 inline-block text-indigo-600 hover:underline">
                Buka Materi →
            </a>
        </div>
    @endforeach

</div>
@endsection
