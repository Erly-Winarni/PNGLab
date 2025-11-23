<x-app-layout>
    <div class="p-6 max-w-2xl">
        <h1 class="text-2xl font-bold">Tambah Course</h1>

        <form action="{{ route('courses.store') }}" method="POST" class="mt-4">
            @csrf

            <label>Nama Course</label>
            <input type="text" name="name" class="w-full p-2 border rounded mb-3">

            <label>Deskripsi</label>
            <textarea name="description" class="w-full p-2 border rounded mb-3"></textarea>

            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" class="w-full p-2 border rounded mb-3">

            <label>Tanggal Selesai</label>
            <input type="date" name="end_date" class="w-full p-2 border rounded mb-3">

            <label>Pilih Teacher</label>
            <select name="teacher_id" class="w-full p-2 border rounded mb-3">
                @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>

            <label>Kategori</label>
            <select name="category_id" class="w-full p-2 border rounded">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
