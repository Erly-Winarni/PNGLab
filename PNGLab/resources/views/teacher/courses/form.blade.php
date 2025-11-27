<div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700 space-y-6">

    {{-- Group 1: Title & Description (Full Width) --}}
    
    <div>
        <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Title</label>
        <input type="text" id="title" name="title" 
               class="bg-[#20232a] text-white border border-gray-600 rounded-lg p-3 w-full focus:ring-blue-500 focus:border-blue-500 transition"
               value="{{ old('title', $course->title ?? '') }}">
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
        <textarea id="description" name="description" rows="4"
                  class="bg-[#20232a] text-white border border-gray-600 rounded-lg p-3 w-full resize-none focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description', $course->description ?? '') }}</textarea>
    </div>

    {{-- Group 2: Category (Full Width) --}}
    
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-300 mb-1">Category</label>
        <select id="category_id" name="category_id" 
                class="bg-[#20232a] text-white border border-gray-600 rounded-lg p-3 w-full focus:ring-blue-500 focus:border-blue-500 transition">
            @foreach ($categories as $c)
            <option value="{{ $c->id }}"
                {{ old('category_id', $course->category_id ?? '') == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
            @endforeach
        </select>
    </div>
    
    <hr class="border-gray-700">

    {{-- Group 3: Date & Max Students (Two Columns on Desktop) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Start Date --}}
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-300 mb-1">Start Date</label>
            <input type="date" id="start_date" name="start_date" 
                   class="bg-[#20232a] text-white border border-gray-600 rounded-lg p-3 w-full focus:ring-blue-500 focus:border-blue-500 transition"
                   value="{{ old('start_date', $course->start_date ?? '') }}">
        </div>

        {{-- End Date --}}
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-300 mb-1">End Date</label>
            <input type="date" id="end_date" name="end_date" 
                   class="bg-[#20232a] text-white border border-gray-600 rounded-lg p-3 w-full focus:ring-blue-500 focus:border-blue-500 transition"
                   value="{{ old('end_date', $course->end_date ?? '') }}">
        </div>

        {{-- Max Students --}}
        <div>
            <label for="max_students" class="block text-sm font-medium text-gray-300 mb-1">Max Students</label>
            <input type="number" id="max_students" name="max_students" 
                   class="bg-[#20232a] text-white border border-gray-600 rounded-lg p-3 w-full focus:ring-blue-500 focus:border-blue-500 transition"
                   value="{{ old('max_students', $course->max_students ?? '') }}">
        </div>

    </div>

    {{-- Group 4: Status Checkbox --}}
    
    <div class="pt-4 border-t border-gray-700">
        <label class="flex items-center text-gray-300 font-medium cursor-pointer">
            <input type="checkbox" name="is_active"
                   class="h-5 w-5 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500"
                   {{-- LOGIC DIBIARKAN SAMA --}}
                   {{ old('is_active', $course->is_active ?? true) ? 'checked' : '' }}>
            <span class="ml-3 text-base">Active Course (Publikasikan sekarang)</span>
        </label>
    </div>

</div>