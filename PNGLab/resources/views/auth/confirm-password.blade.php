<x-guest-layout>
    
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md mx-auto">
        
        <h1 class="text-2xl font-extrabold text-[#193053] mb-6 text-center">Area Aman</h1>

        {{-- Deskripsi --}}
        <div class="mb-6 text-sm text-gray-600 text-center">
            {{ __('Ini adalah area aman aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-6">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-[#193053] font-semibold mb-2" />

                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password" 
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-center mt-4">
                <button type="submit" class="w-full bg-[#446AA6] text-white px-5 py-3 rounded-full font-bold hover:bg-[#264069] transition shadow-md flex items-center justify-center">
                    Konfirmasi
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>