<x-app-layout>
    <div x-data="{ showModal: false, formAction: '' }" class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200">
                <h1 class="text-3xl font-extrabold text-[#193053]">Daftar Materi</h1>

                <a href="{{ route('teacher.contents.create') }}" 
                   class="bg-[#446AA6] text-white px-5 py-2 rounded-full font-semibold hover:bg-[#264069] transition shadow-md flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Materi Baru
                </a>
            </div>

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold text-md text-gray-600 uppercase tracking-wider">Judul Materi</th>
                            <th class="px-6 py-3 font-bold text-md text-gray-600 uppercase tracking-wider hidden sm:table-cell">Kelas</th>
                            <th class="px-6 py-3 font-bold text-md text-gray-600 uppercase tracking-wider hidden md:table-cell">Urutan</th>
                            <th class="px-6 py-3 font-bold text-md text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contents as $content)
                            <tr class="hover:bg-gray-50 transition border-t border-gray-100">
                                <td class="px-6 py-4 text-sm font-medium text-[#193053]">
                                    <a href="{{ route('teacher.contents.edit', $content->id) }}"
                                       class="text-[#446AA6] font-semibold hover:underline">
                                        {{ $content->title }}
                                    </a>
                                </td>
                               
                                <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">
                                    {{ $content->course->title }}
                                </td>
                                
                                <td class="px-6 py-4 text-sm text-gray-600 hidden md:table-cell">
                                    <span class="px-3 py-1 bg-gray-200 rounded-full font-semibold text-xs">{{ $content->order }}</span>
                                </td>
                                
                                <td class="px-6 py-4 text-center space-x-3 whitespace-nowrap">
                                    <a href="{{ route('teacher.contents.edit', $content->id) }}" 
                                       class="text-sm font-medium text-yellow-600 hover:text-yellow-800 hover:underline transition">
                                        Edit
                                    </a>
                                    
                                    <button
                                        type="button"
                                        @click="showModal = true; formAction = '{{ route('teacher.contents.destroy', $content->id) }}';"
                                        class="text-sm font-medium text-red-600 hover:text-red-800 hover:underline transition">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-lg">
                                    Belum ada materi yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $contents->links() }}
            </div>
           
            <x-delete-modal/> 

        </div>
    </div>
</x-app-layout>