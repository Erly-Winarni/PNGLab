<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Kategori</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.categories.form')

        </form>
    </div>
</x-app-layout>
