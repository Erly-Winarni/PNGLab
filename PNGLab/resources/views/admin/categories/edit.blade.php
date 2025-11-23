<x-app-layout>
    <div class="p-6 max-w-lg">
        <h1 class="text-2xl font-bold">Edit Kategori</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <label>Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" class="w-full p-2 border rounded">

            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Update</button>
        </form>
    </div>
</x-app-layout>
