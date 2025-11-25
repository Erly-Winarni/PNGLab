<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">{{ $course->title }}</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @foreach($contents as $content)
            <div class="border p-4 rounded flex justify-between items-center">
                <div>
                    <h4 class="font-semibold">{{ $content->title }}</h4>
                    <p>{{ $content->body }}</p>
                    @if($content->media_url)
                        <a href="{{ $content->media_url }}" target="_blank" class="text-blue-500">Lihat Media</a>
                    @endif
                </div>
                @if(isset($progress[$content->id]) && $progress[$content->id])
                    <span class="text-green-600 font-bold">Selesai</span>
                @else
                    <form action="{{ route('student.dashboard.content.complete', $content->id) }}" method="POST">
                        @csrf
                        <button class="bg-green-500 text-white px-4 py-2 rounded">Tandai Selesai</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
