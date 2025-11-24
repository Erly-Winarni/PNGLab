<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Materi
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('teacher.courses.store') }}" method="POST">
            @csrf

            @include('teacher.courses.form')

            <button class="bg-blue-700 text-white px-4 py-2 rounded mt-4">Create</button>
        </form>
    </div>
</x-app-layout>
