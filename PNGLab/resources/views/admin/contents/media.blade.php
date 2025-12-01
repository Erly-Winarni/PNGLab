<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Kelola Media: {{ $content->title }}
        </h2>
    </x-slot>

    <div class="p-6">

        @foreach ($content->media as $m)
            <div class="flex justify-between items-center mb-3 p-2 border rounded">

                <div>
                    <strong>{{ strtoupper($m->type) }}</strong> —
                    {{ $m->value }}
                </div>

                <form action="{{ route('admin.contents.media.delete', $m->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                        Hapus
                    </button>
                </form>
            </div>
        @endforeach

        @if($content->media->count() === 0)
            <p class="text-gray-500">Tidak ada media.</p>
        @endif

        <a href="{{ route('admin.contents.edit', $content->id) }}"
           class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
            Kembali ke Edit Materi
        </a>
    </div>
</x-app-layout>
