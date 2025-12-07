<div class="space-y-6"> 
    <div>
        <label for="title" class="block text-sm font-semibold text-[#193053] mb-2">Judul Kelas</label>
        <input type="text" id="title" name="title" 
              class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
              value="{{ old('title', $course->title ?? '') }}">
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-semibold text-[#193053] mb-2">Deskripsi Lengkap</label>
        <textarea id="description" name="description" rows="4"
                  class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full resize-none focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">{{ old('description', $course->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="category_id" class="block text-sm font-semibold text-[#193053] mb-2">Kategori</label>
            <select id="category_id" name="category_id" 
                    class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full focus:ring-[#446AA6] focus:border-[#446AA6] transition">
                
                <option value="" {{ old('category_id', $course->category_id ?? '') == '' ? 'selected' : '' }}>
                    -- Pilih Kategori --
                </option>

                @foreach ($categories as $c)
                    <option value="{{ $c->id }}"
                        {{ old('category_id', $course->category_id ?? '') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="teacher_id" class="block text-sm font-semibold text-[#193053] mb-2">Pengajar</label>
            <select id="teacher_id" name="teacher_id" 
                    class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full focus:ring-[#446AA6] focus:border-[#446AA6] transition">
                <option value="">-- Pilih Pengajar --</option>
                @foreach ($teachers as $t)
                    <option value="{{ $t->id }}"
                        {{ old('teacher_id', $course->teacher_id ?? '') == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
            @error('teacher_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <hr class="border-gray-200">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div>
            <label for="start_date" class="block text-sm font-semibold text-[#193053] mb-2">Tanggal Mulai</label>
            <input type="date" id="start_date" name="start_date" 
                   class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                   value="{{ old('start_date', $course->start_date ?? '') }}">
            @error('start_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="end_date" class="block text-sm font-semibold text-[#193053] mb-2">Tanggal Berakhir</label>
            <input type="date" id="end_date" name="end_date" 
                   class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                   value="{{ old('end_date', $course->end_date ?? '') }}">
            @error('end_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="max_students" class="block text-sm font-semibold text-[#193053] mb-2">Maks. Jumlah Siswa</label>
            <input type="number" id="max_students" name="max_students" 
                   class="bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 w-full focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                   value="{{ old('max_students', $course->max_students ?? '') }}">
            @error('max_students')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <hr class="border-gray-200">

    <div class="pt-2">
        <label for="is_active" class="flex items-center text-[#193053] font-semibold cursor-pointer">
            <input type="checkbox" name="is_active" id="is_active"
                   class="h-5 w-5 text-[#446AA6] bg-gray-200 border-gray-300 rounded-md focus:ring-[#446AA6] transition"
                   {{ old('is_active', $course->is_active ?? true) ? 'checked' : '' }}>
            <span class="ml-3 text-base">Aktifkan Kelas (Siap dipublikasikan)</span>
        </label>
        @error('is_active')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="pt-4">
        <button type="submit" 
                class="bg-[#446AA6] text-white px-5 py-2 rounded-full font-bold hover:bg-[#264069] transition shadow-md">
            {{ isset($course) ? 'Update Kelas' : 'Buat Kelas' }}
        </button>
    </div>

</div>