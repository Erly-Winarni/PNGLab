<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-extrabold text-[#193053] mb-8">Edit Profile</h1>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200 mb-10">
            @csrf
            @method('PATCH')

            <h2 class="text-xl font-bold text-[#193053] mb-6 border-b border-gray-200 pb-3">Informasi Pengguna</h2>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-[#193053] mb-3">Avatar</label>
                @php
                    $profilePhoto = $user->avatar 
                        ? asset('storage/' . $user->avatar)
                        : asset('images/profile-default.png'); 
                @endphp

                <input type="file" name="avatar" class="block w-full text-sm text-gray-500 
                       file:mr-4 file:py-2 file:px-4 
                       file:rounded-full file:border-0
                       file:text-sm file:font-semibold
                       file:bg-[#EAF1FF] file:text-[#446AA6] 
                       hover:file:bg-[#CBD2E3]"/>
                @error('avatar') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#193053] mb-2">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-[#193053] mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
                @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button class="bg-[#446AA6] text-white px-5 py-2 rounded-full font-bold hover:bg-[#264069] transition shadow-md">
                Simpan Perubahan
            </button>
        </form>

        <hr class="border-gray-200 my-8">

        <form action="{{ route('profile.password.update') }}" method="POST"
            class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
            @csrf
            @method('PATCH')

            <h2 class="text-xl font-bold text-[#193053] mb-6 border-b border-gray-200 pb-3">Ganti Password</h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#193053] mb-2">Password Lama</label>
                <input type="password" name="current_password" 
                       class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
                @error('current_password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#193053] mb-2">Password Baru</label>
                <input type="password" name="password" 
                       class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
                @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-[#193053] mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" 
                       class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
                @error('password_confirmation') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button class="bg-[#52A397] text-white px-5 py-2 rounded-full font-bold hover:bg-[#326d64] transition shadow-md">
                Update Password
            </button>
        </form>

    </div>
</x-app-layout>