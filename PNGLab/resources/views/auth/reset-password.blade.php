<x-guest-layout>
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md mx-auto">
        
        <h1 class="text-2xl font-extrabold text-[#193053] mb-6 text-center">Atur Ulang Kata Sandi</h1>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <x-input-label for="email" :value="__('Alamat Email')" class="text-[#193053] font-semibold mb-2" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner" 
                    type="email" 
                    name="email" 
                    :value="old('email', $request->email)" 
                    required 
                    autofocus 
                    autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4 mb-4">
                <x-input-label for="password" :value="__('Kata Sandi Baru')" class="text-[#193053] font-semibold mb-2" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4 mb-6">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-[#193053] font-semibold mb-2" />

                <x-text-input 
                    id="password_confirmation" 
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" 
                />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <button type="submit" class="w-full bg-[#446AA6] text-white px-5 py-3 rounded-full font-bold hover:bg-[#264069] transition shadow-md flex items-center justify-center">
                    Atur Ulang Kata Sandi
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>