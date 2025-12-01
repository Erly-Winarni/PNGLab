<x-app-layout>
    <div class="flex flex-col min-h-full bg-[#EAF1FF] text-[#193053]"> 
        <div class="flex justify-between items-center px-6 py-4 sticky top-0 z-10">
            <div class="flex flex-col flex-shrink-0 -mt-6">
                <div class="flex items-center space-x-2"> 
                    <span class="text-xl font-medium text-[#193053]">Selamat Datang</span>
                    <img src="{{ asset('images/PNGY-hello.PNG') }}" alt="Ikon Melambai" class="h-20 w-20 object-contain">
                </div>
                <span class="text-xl font-semibold text-[#193053] -mt-7">{{ Auth::user()->name ?? 'User' }}</span> 
            </div>

            @php
                $authUser = auth()->user();

                $profilePhoto = $authUser->avatar 
                    ? asset('storage/' . $authUser->avatar)
                    : asset('images/profile-default.png');
            @endphp

            <div x-data="{ open: false }" class="relative flex-shrink-0">
                <div @click="open = !open"
                    class="flex items-center space-x-3 bg-white p-2 rounded-full cursor-pointer hover:bg-gray-200 transition">
                    
                     <img class="h-10 w-10 rounded-full object-cover" 
                        src="{{ $profilePhoto }}">

                    <div class="hidden lg:block">
                        <div class="text-sm font-semibold text-[#193053]">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-[#193053]">{{ Auth::user()->email }}</div>
                    </div>

                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>

                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border rounded-xl shadow-lg py-2 z-50">
                    <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-[#193053] hover:bg-gray-200 transition">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-[#193053] hover:bg-red-700 hover:text-white transition">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col md:flex-row flex-1 pt-6"> 
            <div class="flex-1 p-6 overflow-y-auto space-y-8">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="p-6 rounded-xl shadow-xl hover:scale-[1.02] transition duration-300 bg-white" 
                        style="border-bottom: 4px solid #4670A4;">
                        <h3 class="text-lg font-semibold text-[#4670A4] flex items-center">
                            Total Kelas
                        </h3>
                        <p class="mt-3 text-4xl font-extrabold text-[#193053]">{{ $courses->count() }}</p>
                    </div>

                    <div class="p-6 rounded-xl shadow-xl hover:scale-[1.02] transition duration-300 bg-white"
                        style="border-bottom: 4px solid #48C264;">
                        <h3 class="text-lg font-semibold text-[#48C264] flex items-center">
                            Total Siswa
                        </h3>
                        <p class="mt-3 text-4xl font-extrabold text-[#193053]">{{ $totalStudents }}</p>
                    </div>

                    <div class="p-6 rounded-xl shadow-xl hover:scale-[1.02] transition duration-300 bg-white"
                        style="border-bottom: 4px solid #F4A03E;">
                        <h3 class="text-lg font-semibold text-[#F4A03E] flex items-center">
                            Kelas Aktif
                        </h3>
                        <p class="mt-3 text-4xl font-extrabold text-[#193053]">
                            {{ $courses->where('is_active', true)->count() }}
                        </p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-xl">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
                        <h3 class="text-2xl font-bold text-[#193053]">Course Anda</h3>
                        <a href="{{ route('teacher.courses.create') }}" 
                            class="bg-[#446AA6] text-white px-4 py-2 rounded-full font-semibold hover:bg-[#264069] transition flex items-center text-sm">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Buat Baru
                        </a>
                    </div>

                    @if ($courses->count() == 0)
                        <p class="text-gray-500 py-4">Anda belum membuat course apapun. Klik tombol di atas untuk memulai!</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($courses as $course)
                                <div class="bg-gray-50 p-4 rounded-lg flex flex-col md:flex-row justify-between items-start md:items-center 
                                            border border-gray-200 hover:border-[#446AA6] transition duration-200 shadow-sm">
                                    
                                    <div class="mb-3 md:mb-0">
                                        <h4 class="text-xl font-extrabold text-[#193053]">{{ $course->title }}</h4>
                                        <p class="text-gray-500 text-sm mt-1">
                                            <span class="font-medium">Kategori:</span> 
                                            {{ $course->category->name ?? 'Tidak ada kategori' }}
                                        </p>

                                        <div class="flex items-center gap-4 mt-2 text-sm">
                                            <p class="text-gray-500 font-medium">
                                                <span class="font-bold text-lg text-green-600">{{ $course->students_count }}</span> Student
                                            </p>
                                            
                                            @if ($course->is_active)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Draft
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex gap-3 pt-3 md:pt-0">
                                        <a href="{{ route('teacher.courses.show', $course->slug) }}" 
                                            class="px-4 py-2 bg-[#446AA6] text-white rounded-full hover:bg-[#264069] transition text-sm font-semibold">
                                            Kelola
                                        </a>
                                        <a href="{{ route('teacher.courses.edit', $course->id) }}" 
                                            class="px-4 py-2 bg-[#F4A03E] text-white rounded-full hover:bg-yellow-600 transition text-sm font-semibold">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $courses->links() }}
                        </div>
                    @endif
                </div>

            </div>
            
            <aside class="w-full md:w-80 flex-shrink-0 p-6 md:pr-0 overflow-y-auto order-1 md:order-2">
                <div class="bg-white p-6 rounded-xl shadow-xl">
                    <h3 class="text-2xl font-bold text-[#193053] mb-4 border-b border-gray-200 pb-3">Akses Cepat</h3>
                    
                    <div class="grid grid-cols-1 gap-4">
                        
                        <a href="{{ route('teacher.courses.create') }}" 
                            class="block py-4 rounded-xl text-center font-bold text-lg 
                                    bg-[#4670A4] text-white 
                                    hover:bg-[#264069] transition shadow-lg">
                            Tambah Kelas
                        </a>

                        <a href="{{ route('teacher.contents.create') }}" 
                            class="block py-4 rounded-xl text-center font-bold text-lg 
                                    bg-[#48C264] text-white 
                                    hover:bg-green-700 transition shadow-lg">
                            Tambah Materi
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>