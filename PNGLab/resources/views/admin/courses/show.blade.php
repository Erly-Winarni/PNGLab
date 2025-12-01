<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.courses.index') }}" 
                   class="inline-flex items-center text-gray-600 hover:text-[#446AA6] transition text-base font-semibold">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Kelas
                </a>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-200">
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#193053] leading-tight">{{ $course->title }}</h1>
                    <p class="mt-3 text-gray-600 leading-relaxed">{{ $course->description }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Kategori</p>
                        <p class="mt-1 text-lg font-bold text-[#446AA6]">{{ $course->category?->name ?? '-' }}</p>
                    </div>
                   
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Pengajar</p>
                        <p class="mt-1 text-lg font-bold text-[#193053]">{{ $course->teacher->name }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Status Publikasi</p>
                        <p class="mt-1 text-lg font-bold">
                            <span class="{{ $course->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $course->is_active ? 'Active (Publik)' : 'Inactive (Draft)' }}
                            </span>
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Tanggal Mulai</p>
                        <p class="mt-1 text-lg font-bold text-[#193053]">{{ $course->start_date ?? '-' }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Tanggal Berakhir</p>
                        <p class="mt-1 text-lg font-bold text-[#193053]">{{ $course->end_date ?? '-' }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Maks. Siswa</p>
                        <p class="mt-1 text-lg font-bold text-[#193053]">{{ $course->max_students ?? 'Tidak Terbatas' }}</p>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                       class="bg-yellow-600 text-white px-5 py-2 rounded-full font-semibold hover:bg-yellow-700 transition shadow-md">
                        Edit Course
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>