<x-app-layout>
    <div class="p-6 max-w-lg">
        <h1 class="text-2xl font-bold">Tambah Kategori</h1>

        <form action="{{ route('categories.store') }}" method="POST" class="mt-4">
            @csrf

            <label>Nama Kategori</label>
            <input type="text" name="name" class="w-full p-2 border rounded">

            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
