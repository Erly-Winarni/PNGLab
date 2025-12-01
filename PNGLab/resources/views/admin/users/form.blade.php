<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-semibold text-[#193053] mb-2">Username</label>
        <input type="text" id="name" name="name" 
              class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                     focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
              value="{{ old('name', $user->name ?? '') }}">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-semibold text-[#193053] mb-2">Email</label>
        <input type="email" id="email" name="email" 
              class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                     focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
              value="{{ old('email', $user->email ?? '') }}">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-semibold text-[#193053] mb-2">Password</label>
        <input type="password" id="password" name="password" 
              class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
        @if(isset($user))
            <p class="text-gray-500 text-xs mt-1">Kosongkan jika tidak ingin mengubah password.</p>
        @endif
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-semibold text-[#193053] mb-2">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" 
              class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
        @error('password_confirmation')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="role" class="block text-sm font-semibold text-[#193053] mb-2">Role</label>
        <select id="role" name="role" 
                class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 focus:ring-[#446AA6] focus:border-[#446AA6] transition">
            <option value="student" {{ (old('role', $user->role ?? '') == 'student') ? 'selected' : '' }}>Student</option>
            <option value="teacher" {{ (old('role', $user->role ?? '') == 'teacher') ? 'selected' : '' }}>Teacher</option>
        </select>
        @error('role')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="pt-2">
        <label for="is_active" class="flex items-center text-[#193053] font-semibold cursor-pointer">
            <input type="checkbox" name="is_active" id="is_active"
                   class="h-5 w-5 text-[#446AA6] bg-gray-200 border-gray-300 rounded-md focus:ring-[#446AA6] transition"
                   {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
            <span class="ml-3 text-base">Active</span>
        </label>
    </div>

    <div class="pt-4">
        <button type="submit" 
                class="bg-[#446AA6] text-white px-5 py-2 rounded-full font-bold hover:bg-[#264069] transition shadow-md">
            Simpan Perubahan
        </button>
    </div>
</div>