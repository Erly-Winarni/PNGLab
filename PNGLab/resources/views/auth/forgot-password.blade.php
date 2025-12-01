<x-guest-layout>
    
    {{-- Container Card (Simulasi komponen x-guest-layout) --}}
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md mx-auto">
        
        <h1 class="text-2xl font-extrabold text-[#193053] mb-4 text-center">Lupa Kata Sandi?</h1>

        {{-- Deskripsi --}}
        <div class="mb-6 text-sm text-gray-600 text-center">
            {{ __('Lupa kata sandi Anda? Jangan khawatir. Cukup masukkan alamat email Anda dan kami akan mengirimkan tautan reset kata sandi ke email Anda.') }}
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-6">
                <x-input-label for="email" :value="__('Alamat Email')" class="text-[#193053] font-semibold mb-2" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-6">
                <button type="submit" class="w-full bg-[#446AA6] text-white px-5 py-3 rounded-full font-bold hover:bg-[#264069] transition shadow-md flex items-center justify-center">
                    Kirim Tautan Reset Kata Sandi
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>