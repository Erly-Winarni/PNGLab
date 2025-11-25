    <div class="mb-3">
        <label class="block font-medium">Judul</label>
        <input type="text" name="title" class="border p-2 w-full rounded" value="{{ old('title', $content->title ?? '') }}">
        @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-3">
        <label class="block font-medium">Isi Materi</label>
        <textarea name="body" class="border p-2 w-full rounded">{{ old('body', $content->body ?? '') }}</textarea>
        @error('body')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-3">
        <label class="block font-medium">Media URL</label>
        <input type="text" name="media_url" class="border p-2 w-full rounded" value="{{ old('media_url', $content->media_url ?? '') }}">
        @error('media_url')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-3">
        <label class="block font-medium">Urutan</label>
        <input type="number" name="order" class="border p-2 w-full rounded" value="{{ old('order', $content->order ?? 0) }}">
        @error('order')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-3">
        <label class="block font-medium">Teacher</label>
        <select name="teacher_id" id="teacher-select" class="border p-2 w-full rounded">
            <option value="">-- Pilih Teacher --</option>
            @foreach($teachers as $t)
                <option value="{{ $t->id }}" {{ old('teacher_id', $content->teacher_id ?? '') == $t->id ? 'selected' : '' }}>
                    {{ $t->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="block font-medium">Course</label>
        <select name="course_id" id="course-select" class="border p-2 w-full rounded">
            <option value="">-- Pilih Course --</option>
            @foreach($courses as $c)
                <option value="{{ $c->id }}" data-teacher="{{ $c->teacher_id }}"
                    {{ old('course_id', $content->course_id ?? '') == $c->id ? 'selected' : '' }}>
                    {{ $c->title }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
        {{ isset($content) ? 'Update Materi' : 'Buat Materi' }}
    </button>

    <script>
        const teacherSelect = document.getElementById('teacher-select');
        const courseSelect = document.getElementById('course-select');

        teacherSelect.addEventListener('change', () => {
            const selectedTeacher = teacherSelect.value;
            for (const option of courseSelect.options) {
                if (option.value === "" || option.dataset.teacher === selectedTeacher) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            }
            courseSelect.value = ""; 
        });

        teacherSelect.dispatchEvent(new Event('change'));
    </script>

