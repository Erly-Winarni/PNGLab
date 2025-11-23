<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

        <div class="w-full max-w-md bg-white shadow-md rounded-xl p-6">

            <h1 class="text-2xl font-bold mb-1 text-center text-gray-800">Login ke PNGLab</h1>
            <p class="text-sm text-gray-500 mb-6 text-center">
                Masuk untuk melanjutkan belajar
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                               name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                    </label>
                </div>

                <div class="flex flex-col items-center mt-6">
                    <button
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg font-semibold transition">
                        Masuk
                    </button>

                    <p class="mt-4 text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
