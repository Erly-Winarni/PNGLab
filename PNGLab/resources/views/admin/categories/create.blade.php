<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Kategori</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            @include('admin.categories.form')
        </form>
    </div>
</x-app-layout>
