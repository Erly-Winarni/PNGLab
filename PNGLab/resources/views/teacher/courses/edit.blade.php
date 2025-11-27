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

                <button class="bg-green-700 text-white px-4 py-2 rounded mt-4">
                    Update
                </button>
            </form>

        </div>
    </div>

</x-app-layout>
