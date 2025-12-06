<x-guest-layout>
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md mx-auto">
        
        <h1 class="text-2xl font-extrabold text-[#193053] mb-4 text-center">Lupa Kata Sandi?</h1>

        <div class="mb-6 text-sm text-gray-600 text-center">
            Masukkan alamat email Anda dan kami akan mengirimkan tautan reset kata sandi ke email Anda.
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-[#193053] font-semibold mb-2">
                    Alamat Email
                </label>

                <input 
                    id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3  focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                />

                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-center mt-6">
                <button type="submit" class="w-full bg-[#446AA6] text-white px-5 py-3 rounded-full font-bold hover:bg-[#264069] transition shadow-md flex items-center justify-center">
                    Kirim Tautan Reset Kata Sandi
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
