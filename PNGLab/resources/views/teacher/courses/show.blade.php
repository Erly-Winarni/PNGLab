<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-200">
                <div class="mb-6 flex justify-between items-center">
                    <a href="{{ route('teacher.courses.index') }}" 
                       class="text-gray-600 hover:text-[#446AA6] transition flex items-center text-xl font-semibold">
                        &lt; Kembali
                    </a>
                </div>
                
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#193053] leading-tight">{{ $course->name }}</h1>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-[#193053] mb-3">Deskripsi Course</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $course->description }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-gray-200 pt-6">
                    
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Kategori</p>
                        <p class="mt-1 text-lg font-bold text-[#446AA6]">{{ $course->category->name }}</p>
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
                </div>

                <div class="mt-10 bg-gray-50 p-6 rounded-xl border border-gray-200 shadow-md">

                    <h3 class="text-xl font-bold text-[#193053] mb-4 border-b border-gray-200 pb-3">
                        Siswa yang Mengikuti Kelas Ini (Total: {{ $course->students->count() }})
                    </h3>

                    @if ($course->students->count() === 0)
                        <p class="text-gray-500">Belum ada siswa yang mendaftar.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-[#193053] whitespace-nowrap">
                                <thead>
                                    <tr class="border-b border-gray-300">
                                        <th class="py-2 px-1 text-xs font-semibold uppercase tracking-wider">Nama</th>
                                        <th class="py-2 px-1 text-xs font-semibold uppercase tracking-wider hidden sm:table-cell">Email</th>
                                        <th class="py-2 px-1 text-xs font-semibold uppercase tracking-wider w-1/4">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->students as $student)
                                        <tr class="border-b border-gray-200 hover:bg-white transition">
                                            <td class="py-3 px-1 text-sm font-medium">{{ $student->name }}</td>
                                            <td class="py-3 px-1 text-sm text-gray-600 hidden sm:table-cell">{{ $student->email }}</td>
                                            @php
                                                $progress = $course->progressFor($student);
                                            @endphp
                                            <td class="py-3 px-1">
                                                <div class="w-full bg-[#CFCFCF] rounded-full h-3 overflow-hidden">
                                                    <div class="bg-[#52A397] h-3" style="width: {{ $progress }}%;"></div>
                                                </div>
                                                <span class="text-xs text-gray-600 mt-1 block">{{ $progress }}% Selesai</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            {{ $students->links() }}
                        </div>
                    @endif
                </div>
                
                <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                    <a href="{{ route('teacher.courses.edit', $course->id) }}"
                       class="bg-[#F4A03E] text-white px-5 py-2 rounded-full font-semibold hover:bg-yellow-600 transition shadow-md">
                        Edit Kelas
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>