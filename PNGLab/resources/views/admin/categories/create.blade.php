<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Kategori</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            @include('admin.categories.form')

            <button class="bg-green-600 text-white px-4 py-2 rounded mt-4">Simpan</button>
        </form>
    </div>
</x-app-layout>
