<div x-show="showModal" 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300" 
     x-transition:enter="ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;">

    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-transform duration-300"
         @click.away="showModal = false">
        
        <h3 class="text-xl font-bold text-red-600 mb-4">Konfirmasi</h3>
        <p class="text-gray-700 mb-6">
            Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.
        </p>

        <div class="flex justify-end space-x-3">
            <button @click="showModal = false" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-full transition">Batal</button>
            
            <form :action="formAction" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-full hover:bg-red-700 transition">
                    Ya, Hapus Sekarang
                </button>
            </form>
        </div>
    </div>
</div>