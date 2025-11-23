@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Daftar Kursus</h1>

        <form action="{{ route('courses.index') }}" method="GET">
            <input type="text" name="search" placeholder="Cari kursus..."
                class="border p-2 rounded-lg" value="{{ request('search') }}">
        </form>
    </div>

    <!-- Filter Kategori -->
    <div class="mb-6 flex gap-2 flex-wrap">
        @foreach ($categories as $cat)
            <a href="{{ route('courses.index', ['category' => $cat->id]) }}"
               class="px-4 py-1 rounded-full text-sm
               {{ request('category') == $cat->id ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($courses as $course)
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-bold">{{ $course->name }}</h2>
                <p class="text-gray-600 text-sm">{{ Str::limit($course->description, 100) }}</p>

                <p class="text-xs text-gray-500 mt-1">Teacher: {{ $course->teacher->name }}</p>

                <div class="mt-3 flex justify-between items-center">
                    <a href="{{ route('courses.show', $course->id) }}"
                        class="text-indigo-600 font-medium hover:underline">Detail</a>

                    @auth
                        @if(auth()->user()->role == 'student')
                            <form method="POST" action="{{ route('courses.enroll', $course->id) }}">
                                @csrf
                                <button class="px-3 py-1 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-500">
                                    Ikuti
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="/login" class="text-sm text-gray-700 hover:underline">Login untuk mengikuti</a>
                    @endauth
                </div>

                @if (auth()->check() && auth()->user()->isEnrolled($course->id))
                    <div class="mt-2 bg-green-100 text-green-800 text-xs p-2 rounded">
                        Progress: {{ auth()->user()->progressIn($course->id) }}%
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $courses->links() }}
    </div>
</div>
@endsection
