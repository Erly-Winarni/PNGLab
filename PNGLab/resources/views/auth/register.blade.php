<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-4 pt-16 relative overflow-hidden">
        <img src="{{ asset('images/surat-depan.png') }}" class="absolute inset-0 w-full h-full top-56 object-contain pointer-events-none z-20">

        <div class="relative z-10 w-full max-w-md bg-gradient-to-br from-[#446AA6] to-[#5ED68A] rounded-2xl shadow-xl px-6 pt-16 pb-36">
            <h1 class="text-3xl font-bold text-[#446AA6] bg-white px-6 py-1 inline-block absolute -top-6 left-1/2 transform -translate-x-1/2 -rotate-3 shadow-md">
                Daftar
            </h1>

            <a href="{{ url('/') }}"
                class="absolute -top-2 left-4 text-white hover:text-[#264069] text-2xl font-bold mt-5">
                &lt;
            </a>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block font-semibold text-white">Nama Lengkap</label>
                    <input type="text" name="name"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-white">Email</label>
                    <input type="email" name="email"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-white">Daftar Sebagai</label>
                    <select name="role"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white">
                        <option value="">-- Pilih Role --</option>
                        <option value="student" {{ old('role')=='student'?'selected':'' }}>Siswa</option>
                        <option value="teacher" {{ old('role')=='teacher'?'selected':'' }}>Guru</option>
                    </select>
                    @error('role')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-white mb-2">Foto Profil (opsional)</label>
                    
                    <input type="file" name="avatar"
                            class="mt-1 w-full text-sm text-[#264069] 
                                   file:mr-4 file:py-2 file:px-4 
                                   file:rounded-full file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-[#446AA6] file:text-white 
                                   hover:file:bg-[#264069] transition"
                                   >
                                   
                    <p class="text-xs text-white mt-1">Maks 2MB. Format: jpg, png.</p>
                    @error('avatar')
                        <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-white">Password</label>
                    <input type="password" name="password"
                           class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white"
                           required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block font-semibold text-white">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                           class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white"
                           required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-[#446AA6] text-white py-2 rounded-lg font-semibold hover:bg-[#264069] transition">
                    Daftar Sekarang
                </button>

            </form>

            <p class="text-center mt-4 text-sm text-white">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-[#264069] font-semibold hover:underline">
                    Masuk
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
