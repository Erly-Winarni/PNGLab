<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Konten
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('teacher.contents.update', $content->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('teacher.contents.form', ['content' => $content])
        </form>
    </div>
</x-app-layout>
