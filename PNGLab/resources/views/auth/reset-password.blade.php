<x-guest-layout>
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md mx-auto">
        
        <h1 class="text-2xl font-extrabold text-[#193053] mb-6 text-center">Atur Ulang Kata Sandi</h1>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-4">
                <label for="email" class="block text-[#193053] font-semibold mb-2">
                    Alamat Email
                </label>

                <input 
                    id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                />

                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4 mb-4">
                <label for="password" class="block text-[#193053] font-semibold mb-2">
                    Kata Sandi Baru
                </label>

                <input 
                    id="password" type="password" name="password" required autocomplete="new-password"
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                />

                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4 mb-6">
                <label for="password_confirmation" class="block text-[#193053] font-semibold mb-2">
                    Konfirmasi Kata Sandi
                </label>

                <input 
                    id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                />

                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-center mt-4">
                <button type="submit" class="w-full bg-[#446AA6] text-white px-5 py-3 rounded-full font-bold hover:bg-[#264069] transition shadow-md flex items-center justify-center">
                    Atur Ulang Kata Sandi
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
