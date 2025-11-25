{{-- resources/views/admin/courses/form.blade.php --}}
<div class="space-y-4">

    {{-- Title --}}
    <div>
        <label class="block font-medium">Title</label>
        <input type="text" name="title" class="border p-2 w-full rounded"
            value="{{ old('title', $course->title ?? '') }}">
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label class="block font-medium">Description</label>
        <textarea name="description" class="border p-2 w-full rounded">{{ old('description', $course->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Category --}}
    <div>
        <label class="block font-medium">Category</label>
        <select name="category_id" class="border p-2 w-full rounded">
            <option value="">-- Select Category --</option>
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

    {{-- Teacher --}}
    <div>
        <label class="block font-medium">Teacher</label>
        <select name="teacher_id" class="border p-2 w-full rounded">
            <option value="">-- Select Teacher --</option>
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

    {{-- Start Date --}}
    <div>
        <label class="block font-medium">Start Date</label>
        <input type="date" name="start_date" class="border p-2 w-full rounded"
            value="{{ old('start_date', $course->start_date ?? '') }}">
        @error('start_date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- End Date --}}
    <div>
        <label class="block font-medium">End Date</label>
        <input type="date" name="end_date" class="border p-2 w-full rounded"
            value="{{ old('end_date', $course->end_date ?? '') }}">
        @error('end_date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Max Students --}}
    <div>
        <label class="block font-medium">Max Students</label>
        <input type="number" name="max_students" class="border p-2 w-full rounded"
            value="{{ old('max_students', $course->max_students ?? '') }}">
        @error('max_students')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Active Checkbox --}}
    <input type="checkbox" name="is_active" id="is_active"
       {{ old('is_active', $course->is_active ?? true) ? 'checked' : '' }}>
    <label for="is_active">Active Course</label>

</div>
