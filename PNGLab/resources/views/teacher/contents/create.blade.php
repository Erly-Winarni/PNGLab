<x-app-layout>
    <div class="p-6 max-w-2xl">
        <h1 class="text-2xl font-bold">Tambah Materi</h1>

        <form action="{{ route('contents.store') }}" method="POST" class="mt-4">
            @csrf

            <label>Pilih Course</label>
            <select name="course_id" class="w-full p-2 border rounded mb-3">
                @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>

            <label>Judul</label>
            <input type="text" name="title" class="w-full p-2 border rounded mb-3">

            <label>Isi Materi</label>
            <textarea name="body" class="w-full p-2 border rounded"></textarea>

            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
