<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Materi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <a href="{{ route('admin.contents.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                    Tambah Materi
                </a>

                <table class="min-w-full border">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Judul</th>
                            <th class="border px-4 py-2">Course</th>
                            <th class="border px-4 py-2">Teacher</th>
                            <th class="border px-4 py-2">Urutan</th>
                            <th class="border px-4 py-2">Media</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contents as $c)
                        <tr>
                            <td class="border px-4 py-2">{{ $c->title }}</td>
                            <td class="border px-4 py-2">{{ $c->course->title }}</td>
                            <td class="border px-4 py-2">{{ $c->course->teacher->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $c->order }}</td>
                            <td class="border px-4 py-2">{{ $c->media_url }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('admin.contents.edit', $c->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                <form action="{{ route('admin.contents.destroy', $c->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">
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
