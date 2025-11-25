<div class="space-y-4">
    <div>
        <label class="block font-medium">Nama Kategori</label>
        <input type="text" name="name" class="border p-2 w-full rounded" 
               value="{{ old('name', $category->name ?? '') }}">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
