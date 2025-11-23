<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Category List</h1>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah</a>
        </div>

        <table class="w-full mt-6 bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3">ID</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="p-3">{{ $category->id }}</td>
                        <td class="p-3">{{ $category->name }}</td>
                        <td class="p-3 flex gap-3">
                            <a href="{{ route('categories.edit', $category) }}" class="text-blue-500">Edit</a>
                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                @csrf @method('DELETE')
                                <button class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
