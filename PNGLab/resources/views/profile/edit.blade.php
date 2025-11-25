<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">Edit Profile</h1>

        {{-- Edit Biodata --}}
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow mb-8">
            @csrf
            @method('PATCH')

            <h2 class="text-xl font-semibold mb-4">Informasi Pengguna</h2>

            {{-- Avatar --}}
            <div class="mb-4">
                <label class="font-semibold">Avatar</label><br>

                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" 
                         class="w-24 h-24 rounded-full object-cover mb-3">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}" 
                         class="w-24 h-24 rounded-full mb-3">
                @endif

                <input type="file" name="avatar" class="block mt-2">
                @error('avatar') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border p-2 rounded">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border p-2 rounded">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </form>

        {{-- Edit Password --}}
        <form action="{{ route('profile.password.update') }}" method="POST"
            class="bg-white p-6 rounded-xl shadow">
            @csrf
            @method('PATCH')

            <h2 class="text-xl font-semibold mb-4">Ganti Password</h2>

            <div class="mb-4">
                <label class="font-semibold">Password Lama</label>
                <input type="password" name="current_password" class="w-full border p-2 rounded">
                @error('current_password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Password Baru</label>
                <input type="password" name="password" class="w-full border p-2 rounded">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full border p-2 rounded">
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update Password
            </button>
        </form>

    </div>
</x-app-layout>
