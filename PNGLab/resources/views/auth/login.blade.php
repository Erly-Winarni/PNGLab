<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-black p-4 relative overflow-hidden">
        <img src="{{ asset('images/surat-belakang.png') }}" alt="Login Background" class="absolute inset-0 w-full h-full top-12 object-contain pointer-events-none z-0">
        <img src="{{ asset('images/surat-depan.png') }}" alt="Login Background" class="absolute inset-0 w-full h-full top-36 object-contain pointer-events-none z-50">

        <div class="relative z-10 w-full max-w-md" style="
            top: -50px;
            left: 0; 
            transform: translateX(0); 
            background-color: #f6ff74; 
            border-radius: 1rem; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            padding-top: 2rem; 
            padding-left: 2rem; 
            padding-right: 2rem; 
            padding-bottom: 10rem;
        ">
            <h1 class="text-3xl font-bold mb-4 text-center text-indigo-800" style="
                background-color: #2f21f7; 
                color: white; 
                padding: 0.5rem 1.5rem;
                border-radius: 0.5rem;
                display: inline-block;
                position: absolute;
                top: -20px; 
                left: 50%;
                transform: translateX(-50%) rotate(-5deg);
            ">Login</h1>
            <p class="text-sm text-gray-700 mb-6 text-center mt-8">
                Masuk untuk melanjutkan belajar
            </p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="sr-only" /> <x-text-input id="email" class="block w-full"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required autofocus
                                  style="
                                      background-color: white;
                                      border-color: #cbd5e0; /* light gray border */
                                      border-width: 1px;
                                      border-radius: 0.5rem;
                                  " />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" class="sr-only" /> <x-text-input id="password" class="block w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password"
                                  style="
                                      background-color: white;
                                      border-color: #cbd5e0;
                                      border-width: 1px;
                                      border-radius: 0.5rem;
                                  " />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mb-6 text-center">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                               name="remember">
                        <span class="ml-2">{{ __('Ingat saya') }}</span>
                    </label>
                </div>

                <div class="flex flex-col items-center">
                    <button
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-lg font-semibold transition"
                        style="background-color: #2f21f7; 
                               border-radius: 0.5rem;
                               padding: 0.75rem 0;"
                    >
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