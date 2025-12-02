<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4"> 
        <h1 class="text-3xl font-extrabold text-[#193053] mb-8">Ubah Password</h1> 

        <form action="{{ route('profile.password.update') }}" method="POST"
            class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200"> 
            @csrf
            @method('PATCH')

            <div class="mb-5">
                <label class="block font-semibold text-[#193053] mb-2">Password Lama</label>
                <input type="password" name="current_password"
                    class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
                @error('current_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-gray-200 my-6">

            <div class="mb-5">
                <label class="block font-semibold text-[#193053] mb-2">Password Baru</label>
                <input type="password" name="password"
                    class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block font-semibold text-[#193053] mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full bg-gray-50 text-[#193053] border border-gray-300 rounded-xl p-3 
                           focus:ring-[#446AA6] focus:border-[#446AA6] transition shadow-inner">
            </div>

            <button type="submit"
                class="bg-[#446AA6] text-white px-5 py-2 rounded-full font-bold hover:bg-[#264069] transition shadow-md">
                Simpan Password
            </button>
        </form>

    </div>
</x-app-layout>