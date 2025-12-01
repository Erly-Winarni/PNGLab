<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#20232a] p-4 pt-16 relative overflow-hidden">

        {{-- Background surat depan --}}
        <img src="{{ asset('images/surat-depan.png') }}"
             class="absolute inset-0 w-full h-full top-96 object-contain pointer-events-none z-20">

        {{-- Card Register --}}
        <div class="relative z-10 w-full max-w-md bg-gradient-to-b from-[#F6FF76] to-[#E89E66] rounded-2xl shadow-xl px-6 pt-16 pb-36">

            {{-- Judul Register --}}
            <h1 class="text-3xl font-bold text-white bg-blue-700 px-6 py-1 inline-block 
                       absolute -top-6 left-1/2 transform -translate-x-1/2 -rotate-3 shadow-md">
                Daftar
            </h1>

            {{-- Tombol Back --}}
            <a href="{{ url('/') }}"
                class="absolute -top-2 left-4 text-blue-700 hover:text-blue-800 text-2xl font-bold mt-5">
                &lt;
            </a>

            {{-- FORM REGISTER --}}
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block font-semibold text-gray-800">Nama Lengkap</label>
                    <input type="text" name="name"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-800">Email</label>
                    <input type="email" name="email"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-800">Daftar Sebagai</label>
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

                {{-- Avatar --}}
                <div class="mb-4">
                    <label class="block font-semibold text-gray-800">Foto Profil (opsional)</label>
                    <input type="file" name="avatar"
                           class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white">
                    <p class="text-xs text-gray-600 mt-1">Maks 2MB. Format: jpg, png.</p>
                    @error('avatar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label class="block font-semibold text-gray-800">Password</label>
                    <input type="password" name="password"
                           class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white"
                           required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-6">
                    <label class="block font-semibold text-gray-800">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                           class="mt-1 w-full border border-gray-300 rounded-lg p-2 bg-white"
                           required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                    class="w-full bg-blue-700 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                    Daftar Sekarang
                </button>

            </form>

            {{-- Link Login --}}
            <p class="text-center mt-4 text-sm text-gray-700">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-700 font-semibold hover:underline">
                    Masuk
                </a>
            </p>

        </div>
    </div>
</x-guest-layout>
