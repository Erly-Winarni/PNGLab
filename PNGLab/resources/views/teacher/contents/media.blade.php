<x-app-layout>
    <div x-data="{ showModal: false, formAction: '' }" class="py-10">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
                <div class="mb-6 flex justify-between items-center" >
                    <a href="{{ route('teacher.contents.edit', $content->id) }}"
                    class="text-gray-600 hover:text-[#446AA6] transition flex items-center text-xl font-semibold">
                        &lt; Kembali
                    </a>
                </div>
                
                <h3 class="text-xl font-bold text-[#193053] mb-4">
                    Media untuk: <span class="font-bold text-[#193053]">{{ $content->title }}</span>
                </h3>

                @forelse ($content->media as $m)
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 p-4 rounded-xl border border-gray-200 bg-gray-50 shadow-sm">

                        <div class="mb-2 sm:mb-0 max-w-full truncate">
                            <span class="px-4 py-0.5 text-xs font-bold rounded-xl uppercase mr-2 
                                {{ $m->type === 'youtube' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ strtoupper($m->type) }}
                            </span>
                            <span class="text-sm text-gray-700 break-words">{{ Str::limit($m->value, 80) }}</span>
                        </div>

                        <button
                            type="button"
                            @click="showModal = true; formAction = '{{ route('teacher.contents.media.delete', $m->id) }}';"
                            class="text-sm font-medium bg-red-600 text-white px-6 py-2 rounded-xl hover:bg-red-700 transition shadow-md flex-shrink-0">
                            Hapus
                        </button>
                    </div>
                @empty
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-gray-500">Tidak ada media yang terkait dengan materi ini.</p>
                    </div>
                @endforelse

            </div>
        </div>
        
        <x-delete-modal/> 

    </div>
</x-app-layout>