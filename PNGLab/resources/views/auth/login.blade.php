<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#20232a] p-4 relative overflow-hidden">

        {{-- Background surat depan --}}
        <img src="{{ asset('images/surat-depan.png') }}"
             class="absolute inset-0 w-full h-full top-44 object-contain pointer-events-none z-20">

        {{-- Card Login --}}
        <div class="relative z-10 w-full max-w-md bg-gradient-to-b from-[#F6FF76] to-[#E89E66] rounded-2xl shadow-xl px-6 pt-16 pb-44">

            {{-- Judul Login --}}
            <h1 class="text-3xl font-bold text-white bg-blue-700 px-6 py-1 inline-block 
                       absolute -top-6 left-1/2 transform -translate-x-1/2 -rotate-3 shadow-md">
                Masuk
            </h1>

            {{-- Tombol Back --}}
            <a href="{{ url('/') }}"
                class="absolute -top-2 left-4 text-blue-700 hover:text-blue-800 text-2xl font-bold mt-5">
                &lt;
            </a>

            {{-- Status Session --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- FORM LOGIN --}}
            <form method="POST" action="{{ route('login') }}" style="mt-5">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />

                    <x-text-input id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus
                        class="mt-1 block w-full border border-gray-300 rounded-lg bg-white" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div class="mb-2">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />

                    <x-text-input id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="mt-1 block w-full border border-gray-300 rounded-lg bg-white" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Forgot password & Remember me (sejajar) --}}
                <div class="flex justify-between items-center mb-6">
                    {{-- Remember me --}}
                    <label class="flex items-center text-sm text-gray-700">
                        <input id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-blue-700 focus:ring-blue-500"
                            name="remember">
                        <span class="ml-2">Ingat saya</span>
                    </label>

                    {{-- Forgot password --}}
                    <a href="{{ route('password.request') }}"
                    class="text-sm text-blue-700 font-medium hover:underline">
                        Lupa Kata Sandi?
                    </a>
                </div>

                {{-- Tombol Masuk --}}
                <button
                    class="w-full bg-blue-700 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                    Masuk
                </button>

                {{-- Link Register --}}
                <p class="mt-4 text-center text-sm text-gray-700">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-700 font-semibold hover:underline">
                        Daftar sekarang
                    </a>
                </p>

            </form>
        </div>
    </div>
</x-guest-layout>
