<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Konten
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('teacher.contents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('teacher.contents.form')
        </form>

    </div>
</x-app-layout>
