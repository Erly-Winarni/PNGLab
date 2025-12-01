<div class="space-y-6 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div>
        <label for="name" class="block text-sm font-semibold text-[#193053] mb-2">Nama Kategori</label>
        <input type="text" id="name" name="name" 
               class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner" 
               value="{{ old('name', $category->name ?? '') }}">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="pt-4">
        <button type="submit" 
                class="bg-[#446AA6] text-white px-5 py-2 rounded-full font-bold hover:bg-[#264069] transition shadow-md">
            {{ isset($category) ? 'Update Kategori' : 'Simpan Kategori' }}
        </button>
    </div>
</div>