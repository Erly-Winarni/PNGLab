<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kursus (Admin)
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow rounded-lg">

            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.courses.form', [
                    'course' => $course,
                    'categories' => $categories,
                    'teachers' => $teachers
                ])
            </form>

        </div>
    </div>

</x-app-layout>
