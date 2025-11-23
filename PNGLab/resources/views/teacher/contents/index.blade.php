<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Materi Pembelajaran</h1>
            <a href="{{ route('contents.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah</a>
        </div>

        <table class="w-full mt-6 bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3">Judul</th>
                    <th class="p-3">Course</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($contents as $content)
                <tr>
                    <td class="p-3">{{ $content->title }}</td>
                    <td class="p-3">{{ $content->course->name }}</td>
                    <td class="p-3 flex gap-3">
                        <a href="{{ route('contents.edit', $content) }}" class="text-blue-500">Edit</a>

                        <form method="POST" action="{{ route('contents.destroy', $content) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
