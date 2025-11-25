<div class="space-y-4">
    {{-- Username --}}
    <div>
        <label class="block font-medium">Username</label>
        <input type="text" name="name" class="border p-2 w-full rounded"
            value="{{ old('name', $user->name ?? '') }}">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label class="block font-medium">Email</label>
        <input type="email" name="email" class="border p-2 w-full rounded"
            value="{{ old('email', $user->email ?? '') }}">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <label class="block font-medium">Password</label>
        <input type="password" name="password" class="border p-2 w-full rounded">
        @if(isset($user))
            <p class="text-gray-500 text-sm">Kosongkan jika tidak ingin mengubah password.</p>
        @endif
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div>
        <label class="block font-medium">Confirm Password</label>
        <input type="password" name="password_confirmation" class="border p-2 w-full rounded">
        @error('password_confirmation')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    {{-- Role --}}
    <div>
        <label class="block font-medium">Role</label>
        <select name="role" class="border p-2 w-full rounded">
            <option value="student" {{ (old('role', $user->role ?? '') == 'student') ? 'selected' : '' }}>Student</option>
            <option value="teacher" {{ (old('role', $user->role ?? '') == 'teacher') ? 'selected' : '' }}>Teacher</option>
        </select>
        @error('role')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status aktif/non-aktif --}}
    <div class="flex items-center space-x-2">
        <input type="checkbox" name="is_active" id="is_active"
            {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
        <label for="is_active" class="font-medium">Active</label>
    </div>
</div>
