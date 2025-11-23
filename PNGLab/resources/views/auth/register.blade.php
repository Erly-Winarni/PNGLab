<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 shadow-lg rounded-xl">

        <h1 class="text-2xl font-bold mb-6 text-center">Daftar Akun PNGLab</h1>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border rounded p-2"
                       required value="{{ old('name') }}">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2"
                       required value="{{ old('email') }}">
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Daftar Sebagai</label>
                <select name="role" class="w-full border rounded p-2" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>

            <!-- Avatar -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Foto Profil (opsional)</label>
                <input type="file" name="avatar" class="w-full border rounded p-2">
                <p class="text-xs text-gray-600 mt-1">Maks 2MB. Format: jpg, png.</p>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-500 transition">
                Daftar Sekarang
            </button>

        </form>

        <p class="text-center mt-4 text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold">Login</a>
        </p>

    </div>
</x-guest-layout>
