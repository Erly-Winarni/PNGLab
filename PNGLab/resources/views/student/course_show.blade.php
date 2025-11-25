<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">{{ $course->title }}</h2>
    </x-slot>

    <div class="p-6 space-y-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded">{{ session('success') }}</div>
        @endif

        <h3 class="font-bold text-lg">Materi</h3>

        <ul class="space-y-2">
            @foreach($contents as $content)
                <li class="border p-3 rounded flex justify-between items-center">
                    <div>
                        <strong>{{ $content->order }}. {{ $content->title }}</strong><br>
                        <small>{{ $content->body }}</small>
                        @if($content->media_url)
                            <div>
                                <a href="{{ $content->media_url }}" target="_blank" class="text-blue-600 underline">Media</a>
                            </div>
                        @endif
                    </div>

                    <div>
                        @if(isset($progress[$content->id]) && $progress[$content->id])
                            <span class="bg-green-500 text-white px-3 py-1 rounded">Selesai</span>
                        @else
                            <form action="{{ route('student.contents.complete', $content->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Tandai Selesai</button>
                            </form>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
</x-app-layout>
