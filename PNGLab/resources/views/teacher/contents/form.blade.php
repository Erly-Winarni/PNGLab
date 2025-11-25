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
        <label class="block font-medium">Course</label>
        <select name="course_id" class="border p-2 w-full rounded">
            @foreach($courses as $c)
                <option value="{{ $c->id }}" {{ old('course_id', $content->course_id ?? '') == $c->id ? 'selected' : '' }}>
                    {{ $c->title }}
                </option>
            @endforeach
        </select>
        @error('course_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
        {{ isset($content) ? 'Update Materi' : 'Buat Materi' }}
    </button>
