<x-app-layout>
    <div x-data="{ showModal: false, formAction: '' }" class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200">
                <h1 class="text-3xl font-extrabold text-[#193053]">Kelola Kategori</h1>

                <a href="{{ route('admin.categories.create') }}" 
                   class="bg-[#446AA6] text-white px-5 py-2 rounded-full font-semibold hover:bg-[#264069] transition shadow-md flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Kategori
                </a>
            </div>

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold text-md text-gray-600 uppercase tracking-wider hidden sm:table-cell w-1/12">No</th> 
                            <th class="px-6 py-3 font-bold text-md text-gray-600 uppercase tracking-wider">Nama Kategori</th>
                            <th class="px-6 py-3 font-bold text-md text-gray-600 uppercase tracking-wider text-center w-1/4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition border-t border-gray-100">
                                <td class="px-6 py-4 text-sm text-gray-500 hidden sm:table-cell">{{ $loop->iteration }}</td>
                                
                                <td class="px-6 py-4 text-sm font-semibold text-[#446AA6]">{{ $category->name }}</td>
                               
                                <td class="px-6 py-4 text-center space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                       class="text-sm font-medium text-yellow-600 hover:text-yellow-800 hover:underline transition">
                                        Edit
                                    </a>

                                    <button
                                        type="button"
                                        @click="showModal = true; formAction = '{{ route('admin.categories.destroy', $category->id) }}';"
                                        class="text-sm font-medium text-red-600 hover:text-red-800 hover:underline transition">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500 text-lg">
                                    Belum ada kategori yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        
            <x-delete-modal/> 

        </div>
    </div>
</x-app-layout>