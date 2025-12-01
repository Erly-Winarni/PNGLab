<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Materi Saya
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <a href="{{ route('teacher.contents.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                    Tambah Materi
                </a>

                <table class="min-w-full border">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Judul</th>
                            <th class="border px-4 py-2">Course</th>
                            <th class="border px-4 py-2">Urutan</th>
                            <th class="border px-4 py-2">Media</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contents as $content)
                        <tr>
                            <td class="border px-4 py-2">{{ $content->title }}</td>
                            <td class="border px-4 py-2">{{ $content->course->title }}</td>
                            <td class="border px-4 py-2">{{ $content->order }}</td>
                            <td class="border px-4 py-2">{{ $content->media_url }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('teacher.contents.edit', $content->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                <form action="{{ route('teacher.contents.destroy', $content->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded"
                                        onclick="return confirm('Apakah yakin ingin menghapus materi ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $contents->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
