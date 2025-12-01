<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Materi (Admin)
        </h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('admin.contents.media.index', $content->id) }}"
           class="bg-gray-600 text-white px-3 py-1 rounded block w-max mb-4">
            Kelola Media
        </a>
        
        <form action="{{ route('admin.contents.update', $content->id) }}" 
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.contents.form')

        </form>
    </div>
</x-app-layout>
