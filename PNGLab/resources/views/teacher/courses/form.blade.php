<div>
    <label class="block">Title</label>
    <input type="text" name="title" class="border p-2 w-full"
        value="{{ old('title', $course->title ?? '') }}">
</div>

<div class="mt-3">
    <label class="block">Description</label>
    <textarea name="description" class="border p-2 w-full">{{ old('description', $course->description ?? '') }}</textarea>
</div>

<div class="mt-3">
    <label class="block">Category</label>
    <select name="category_id" class="border p-2 w-full">
        @foreach ($categories as $c)
        <option value="{{ $c->id }}"
            {{ old('category_id', $course->category_id ?? '') == $c->id ? 'selected' : '' }}>
            {{ $c->name }}
        </option>
        @endforeach
    </select>
</div>

<div class="mt-3">
    <label>Start Date</label>
    <input type="date" name="start_date" class="border p-2 w-full"
        value="{{ old('start_date', $course->start_date ?? '') }}">
</div>

<div class="mt-3">
    <label>End Date</label>
    <input type="date" name="end_date" class="border p-2 w-full"
        value="{{ old('end_date', $course->end_date ?? '') }}">
</div>

<div class="mt-3">
    <label>Max Students</label>
    <input type="number" name="max_students" class="border p-2 w-full"
        value="{{ old('max_students', $course->max_students ?? '') }}">
</div>

<div class="mt-3">
    <label class="flex items-center">
        <input type="checkbox" name="is_active"
            {{ old('is_active', $course->is_active ?? true) ? 'checked' : '' }}>
        <span class="ml-2">Active Course</span>
    </label>
</div>
