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
        </form>
    </div>
</x-app-layout>
