<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Materi (Admin)
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.contents.store') }}" method="POST">
            @csrf

            @include('admin.contents.form')

        </form>
    </div>
</x-app-layout>
