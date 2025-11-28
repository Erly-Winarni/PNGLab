<div class="mb-3">
    <label class="block font-medium">Judul</label>
    <input type="text" name="title" class="border p-2 w-full rounded"
        value="{{ old('title', $content->title ?? '') }}">
    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-3">
    <label class="block font-medium">Isi Materi</label>
    <textarea name="body" class="border p-2 w-full rounded">{{ old('body', $content->body ?? '') }}</textarea>
    @error('body')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-3">
    <label class="block font-medium">Media URL</label>
    <input type="text" name="media_url" class="border p-2 w-full rounded"
        value="{{ old('media_url', $content->media_url ?? '') }}">
    @error('media_url')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-3">
    <label class="block font-medium">Upload File (PDF / DOC / DOCX)</label>
    <input type="file" name="media_file" class="border p-2 w-full rounded">
    @error('media_file')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

{{-- PREVIEW MEDIA — hanya muncul jika $content ada --}}
@if (isset($content) && $content->media_type)

    {{-- YouTube --}}
    @if ($content->media_type === 'youtube')
        <iframe width="100%" height="400"
            src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($content->media_url, 'v=') }}"
            frameborder="0" allowfullscreen>
        </iframe>

    {{-- External PDF --}}
    @elseif ($content->media_type === 'pdf')
        <embed src="{{ $content->media_url }}" type="application/pdf" width="100%" height="500px" />

    {{-- External DOC/DOCX --}}
    @elseif ($content->media_type === 'doc' || $content->media_type === 'docx')
        <iframe src="https://docs.google.com/gview?url={{ $content->media_url }}&embedded=true"
            style="width:100%; height:500px;" frameborder="0"></iframe>

    {{-- Uploaded PDF --}}
    @elseif ($content->media_type === 'file_pdf')
        <embed src="{{ asset('storage/' . $content->media_path) }}"
            type="application/pdf" width="100%" height="500px" />

    {{-- Uploaded DOC/DOCX --}}
    @elseif ($content->media_type === 'file_doc' || $content->media_type === 'file_docx')
        <iframe src="https://docs.google.com/gview?url={{ asset('storage/' . $content->media_path) }}&embedded=true"
            style="width:100%; height:500px;" frameborder="0"></iframe>

    @endif
@endif

<div class="mb-3">
    <label class="block font-medium">Urutan</label>
    <input type="number" name="order" class="border p-2 w-full rounded"
        value="{{ old('order', $content->order ?? 0) }}">
    @error('order')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<div class="mb-3">
    <label class="block font-medium">Course</label>
    <select name="course_id" class="border p-2 w-full rounded">
        @foreach($courses as $c)
            <option value="{{ $c->id }}"
                {{ old('course_id', $content->course_id ?? '') == $c->id ? 'selected' : '' }}>
                {{ $c->title }}
            </option>
        @endforeach
    </select>
    @error('course_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
    {{ isset($content) ? 'Update Materi' : 'Buat Materi' }}
</button>
