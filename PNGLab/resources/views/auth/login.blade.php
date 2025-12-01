<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
        <img src="{{ asset('images/surat-depan.png') }}" class="absolute inset-0 w-full h-full top-2 object-contain pointer-events-none z-20">

        <div class="relative z-10 w-full max-w-md bg-gradient-to-br from-[#446AA6] to-[#5ED68A] rounded-2xl shadow-xl px-6 pt-16 pb-44">
            <h1 class="text-3xl font-bold text-[#446AA6] bg-white px-6 py-1 inline-block absolute -top-6 left-1/2 transform -translate-x-1/2 -rotate-3 shadow-md">
                Masuk
            </h1>

            <a href="{{ url('/') }}"
                class="absolute -top-2 left-4 text-white hover:text-[#264069] text-2xl font-bold mt-5">
                &lt;
            </a>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" style="mt-5">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-white" />

                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus class="mt-1 block w-full border border-gray-300 rounded-lg bg-white" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-2">
                    <x-input-label for="password" :value="__('Password')" class="text-white" />

                    <x-text-input id="password" type="password" name="password" required autocomplete="current-password" class="mt-1 block w-full border border-gray-300 rounded-lg bg-white" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('password.request') }}"
                    class="text-sm text-white font-medium hover:underline">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <button
                    class="w-full bg-[#446AA6] text-white py-2 rounded-lg font-semibold hover:bg-[#264069] transition">
                    Masuk
                </button>

                <p class="mt-4 text-center text-sm text-white">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-[#264069] font-semibold hover:underline">
                        Daftar sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
