<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-4 mb-8 relative overflow-hidden">
        <div class="relative z-10 w-full max-w-md bg-gradient-to-br from-[#446AA6] to-[#5ED68A] rounded-2xl shadow-xl px-6 pt-16 pb-44">
          
            <h1 class="text-3xl font-bold text-[#446AA6] bg-white px-6 py-1 inline-block absolute -top-6 left-1/2 transform -translate-x-1/2 -rotate-3 shadow-md">
                Masuk
            </h1>

            <a href="{{ url('/') }}"
                class="absolute -top-2 left-4 text-white hover:text-[#264069] text-2xl font-bold mt-5">
                &lt;
            </a>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="text-white block font-semibold mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full border border-gray-300 rounded-xl p-3 bg-white text-[#193053] focus:ring-[#264069] focus:border-[#264069] transition" />
                    
                    @error('email')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="text-white block font-semibold mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"  class="mt-1 block w-full border border-gray-300 rounded-xl p-3 bg-white text-[#193053] focus:ring-[#264069] focus:border-[#264069] transition" />
                    
                    @error('password')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-white font-medium hover:underline">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <button type="submit"
                    class="w-full bg-[#446AA6] text-white py-3 rounded-full font-bold hover:bg-[#264069] transition shadow-lg">
                    Masuk
                </button>

                <p class="mt-4 text-center text-sm text-white">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-white font-semibold hover:text-[#193053] hover:underline transition">
                        Daftar sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>