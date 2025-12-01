{{-- ===================== JUDUL ===================== --}}
<div class="mb-3">
    <label class="block font-medium">Judul</label>
    <input type="text" name="title" class="border p-2 w-full rounded"
           value="{{ old('title', $content->title ?? '') }}">
    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

{{-- ===================== ISI ===================== --}}
<div class="mb-3">
    <label class="block font-medium">Isi Materi</label>
    <textarea name="body" class="border p-2 w-full rounded">{{ old('body', $content->body ?? '') }}</textarea>
    @error('body')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

{{-- ===================== INPUT URL MULTIPLE ===================== --}}
<div id="url-wrapper" class="mb-3">
    <label class="font-medium">Media URL (YouTube / PDF / DOCX)</label>

    {{-- satu input awal --}}
    <input type="text" name="media_urls[]" class="border p-2 w-full rounded mb-2">

    {{-- tombol tambah --}}
    <button type="button" onclick="addUrl()" 
        class="bg-green-600 text-white px-2 py-1 rounded">+ Tambah URL</button>
</div>

<script>
function addUrl() {
    const wrapper = document.getElementById('url-wrapper');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'media_urls[]';
    input.className = 'border p-2 w-full rounded mt-2';
    wrapper.appendChild(input);
}
</script>

{{-- ===================== PDF MULTIPLE ===================== --}}
<div class="mb-3">
    <label class="font-medium">Upload File PDF (Multiple)</label>
    <input type="file" name="media_files[]" multiple class="border p-2 w-full rounded">
    @error('media_files.*')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
</div>


{{-- ===================== ORDER ===================== --}}
<div class="mb-3">
    <label class="block font-medium">Urutan</label>
    <input type="number" name="order" class="border p-2 w-full rounded"
           value="{{ old('order', $content->order ?? 0) }}">
    @error('order')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

{{-- ===================== COURSE ===================== --}}
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

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    {{ isset($content) ? 'Update Materi' : 'Buat Materi' }}
</button>
