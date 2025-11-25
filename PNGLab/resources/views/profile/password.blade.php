<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-2xl font-bold mb-6">Ubah Password</h1>

        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- Password lama --}}
            <div class="mb-4">
                <label class="block font-medium mb-2">Password Lama</label>
                <input type="password" name="current_password"
                    class="w-full border rounded-lg p-2">
                @error('current_password')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Baru --}}
            <div class="mb-4">
                <label class="block font-medium mb-2">Password Baru</label>
                <input type="password" name="password"
                    class="w-full border rounded-lg p-2">
                @error('password')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi --}}
            <div class="mb-4">
                <label class="block font-medium mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full border rounded-lg p-2">
            </div>

            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Password
            </button>
        </form>

    </div>
</x-app-layout>
