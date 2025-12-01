<div class="bg-white p-6 rounded-2xl shadow-xl space-y-6 border border-gray-100 text-[#193053]">
    <div class="mb-3">
        <label for="title" class="block text-sm font-semibold text-[#193053] mb-2">Judul Materi</label>
        <input type="text" id="title" name="title" 
            class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full 
                   focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
            value="{{ old('title', $content->title ?? '') }}">
        @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="mb-3">
        <label for="body" class="block text-sm font-semibold text-[#193053] mb-2">Isi Materi (Teks)</label>
        <textarea id="body" name="body" rows="6"
            class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full resize-none 
                   focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">{{ old('body', $content->body ?? '') }}</textarea>
        @error('body')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <hr class="border-gray-200">

    <div class="mb-3">
        <label class="block text-sm font-semibold text-[#193053] mb-2">Media URL (YouTube / PDF Eksternal)</label>
        
        <div id="url-wrapper" class="flex flex-col space-y-2"> 
            <div class="flex items-center space-x-2 w-full">
                <input type="text" name="media_urls[]" placeholder="Contoh: https://www.youtube.com/watch?v=..."
                       class="border border-gray-300 p-3 w-full rounded-xl bg-gray-50 focus:ring-[#446AA6] focus:border-[#446AA6]">
            </div>
            
        </div>
        
        <button type="button" onclick="addUrl()" 
            class="bg-[#446AA6] text-white px-4 py-2 rounded-full mt-3 font-semibold hover:bg-[#264069] transition flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah URL
        </button>
    </div>

    <div class="mb-3 pt-4 border-t border-gray-200">
        <label for="media_files" class="block text-sm font-semibold text-[#193053] mb-2">Upload File PDF (Maks. 5 file)</label>
        <input type="file" id="media_files" name="media_files[]" multiple 
            class="w-full text-sm text-gray-500 
                    file:mr-4 file:py-2 file:px-4 
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-[#EAF1FF] file:text-[#446AA6] 
                    hover:file:bg-[#CBD2E3]"/>
        @error('media_files.*')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-200">
        <div>
            <label for="order" class="block text-sm font-semibold text-[#193053] mb-2">Urutan Materi</label>
            <input type="number" id="order" name="order" 
                   class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full 
                          focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                   value="{{ old('order', $content->order ?? 0) }}">
            @error('order')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="course_id" class="block text-sm font-semibold text-[#193053] mb-2">Course Terkait</label>
            <select id="course_id" name="course_id" 
                    class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition">
                @foreach($courses as $c)
                    <option value="{{ $c->id }}"
                        {{ old('course_id', $content->course_id ?? '') == $c->id ? 'selected' : '' }}>
                        {{ $c->title }}
                    </option>
                @endforeach
            </select>
            @error('course_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    
    <div class="pt-6">
        <button class="bg-[#446AA6] text-white px-5 py-2 rounded-full font-bold hover:bg-[#264069] transition shadow-md">
            {{ isset($content) ? 'Update Materi' : 'Buat Materi' }}
        </button>
    </div>

</div>

<script>
function addUrl() {
    const wrapper = document.getElementById('url-wrapper');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center space-x-2 mt-2';

    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'media_urls[]';
    input.placeholder = 'URL Tambahan';
    input.className = 'border border-gray-300 p-3 w-full rounded-xl bg-gray-50 focus:ring-[#446AA6] focus:border-[#446AA6]';
    
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.innerHTML = '—'; 
    removeButton.className = 'bg-red-500 text-white p-2 rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition flex-shrink-0';
    removeButton.onclick = function() {
        newDiv.remove();
    };

    newDiv.appendChild(input);
    newDiv.appendChild(removeButton);

    const existingContainers = wrapper.querySelectorAll('div');
    
    if (existingContainers.length > 0) {
        existingContainers[existingContainers.length - 1].after(newDiv);
    } else {
        wrapper.prepend(newDiv);
    }
}
</script>