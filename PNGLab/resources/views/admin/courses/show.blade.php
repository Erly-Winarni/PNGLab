<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Kursus (Admin)
        </h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold">{{ $course->title }}</h1>

        <p class="mt-3 text-gray-700">{{ $course->description }}</p>

        <p class="mt-4"><strong>Category:</strong> {{ $course->category?->name ?? '-' }}</p>
        <p><strong>Teacher:</strong> {{ $course->teacher->name }}</p>
        <p><strong>Start Date:</strong> {{ $course->start_date ?? '-' }}</p>
        <p><strong>End Date:</strong> {{ $course->end_date ?? '-' }}</p>
        <p><strong>Max Students:</strong> {{ $course->max_students ?? '-' }}</p>
        <p><strong>Status:</strong> 
            <span class="{{ $course->is_active ? 'text-green-600' : 'text-red-600' }}">
                {{ $course->is_active ? 'Active' : 'Inactive' }}
            </span>
        </p>

        <a href="{{ route('admin.courses.index') }}" class="text-blue-600 mt-6 inline-block">← Back</a>
    </div>
</x-app-layout>
