<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Materi (Admin)
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.contents.update', $content->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.contents.form')

        </form>
    </div>
</x-app-layout>
