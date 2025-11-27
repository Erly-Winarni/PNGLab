<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-3">{{ $content->title }}</h1>

        <div class="prose mb-6">
            {!! nl2br(e($content->body)) !!}
        </div>

        @if (!$previousCompleted)
            <div class="p-3 bg-red-100 text-red-700 rounded mb-4">
                Selesaikan konten sebelumnya terlebih dahulu.
            </div>
        @endif

        <form action="{{ route('student.contents.complete', [$course->slug, $content->id]) }}" method="POST">
            @csrf
            <button type="submit"
                @disabled(!$previousCompleted)
                class="px-4 py-2 bg-blue-500 text-white rounded disabled:bg-gray-400">
                Tandai Selesai
            </button>
        </form>
    </div>
</x-app-layout>
