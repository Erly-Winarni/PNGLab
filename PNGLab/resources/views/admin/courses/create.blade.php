<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Kursus Baru (Admin)
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf

            @include('admin.courses.form', ['categories' => $categories, 'teachers' => $teachers])

            <button class="bg-green-600 text-white px-4 py-2 rounded mt-4">
                Buat Kursus
            </button>
        </form>
    </div>
</x-app-layout>
