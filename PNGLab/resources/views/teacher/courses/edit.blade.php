<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Materi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto p-6 shadow rounded-lg">

            <form action="{{ route('teacher.courses.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('teacher.courses.form', ['course' => $course])
            </form>

        </div>
    </div>

</x-app-layout>
