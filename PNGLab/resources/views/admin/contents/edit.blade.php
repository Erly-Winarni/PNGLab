<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Materi (Admin)
        </h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('teacher.contents.media.index', $content->id) }}"
           class="bg-[#446AA6] font-semibold text-white px-3 py-1 mt-10 rounded-2xl block w-max mb-4">
            Kelola Media >
        </a>

        <form action="{{ route('admin.contents.update', $content->id) }}" 
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.contents.form')
        </form>
    </div>
</x-app-layout>
