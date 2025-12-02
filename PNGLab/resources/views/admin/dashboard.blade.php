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
                <h1 class="text-2xl font-bold text-[#193053] mb-4">Dashboard Administrasi</h1>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-xl hover:scale-[1.03] transition duration-300 border-b-4 border-[#446AA6]">
                        <h3 class="text-sm font-medium text-gray-500">Total Pengguna</h3>
                        <p class="mt-1 text-3xl font-extrabold text-[#446AA6]">{{ $totalUsers }}</p>
                        <span class="text-xs text-gray-500">Kelola via Pengguna</span>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-xl hover:scale-[1.03] transition duration-300 border-b-4 border-[#da5353]">
                        <h3 class="text-sm font-medium text-gray-500">Total Kelas</h3>
                        <p class="mt-1 text-3xl font-extrabold text-[#da5353]">{{ $totalCourses }}</p>
                        <span class="text-xs text-gray-500">Kelola Via Manage Kelas</span>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-xl hover:scale-[1.03] transition duration-300 border-b-4 border-[#48C264]">
                        <h3 class="text-sm font-medium text-gray-500">Pengajar Aktif</h3>
                        <p class="mt-1 text-3xl font-extrabold text-[#48C264]">{{ $totalTeachers }}</p>
                        <span class="text-xs text-gray-500">Kelola via Pengguna</span>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-xl hover:scale-[1.03] transition duration-300 border-b-4 border-[#F4A03E]">
                        <h3 class="text-sm font-medium text-gray-500">Kategori Total</h3>
                        <p class="mt-1 text-3xl font-extrabold text-[#F4A03E]">{{ $totalCategories }}</p>
                        <span class="text-xs text-gray-500">Kelola Via Kategori</span>
                    </div>
                </div>
            </div>
            
            <aside class="w-full md:w-80 flex-shrink-0 p-6 md:pr-0 overflow-y-auto order-1 md:order-2">
                <div class="bg-white p-6 rounded-xl shadow-xl">
                    <h3 class="text-2xl font-bold text-[#193053] mb-4 border-b border-gray-200 pb-3">Aksi Cepat</h3>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <a href="{{ route('admin.categories.create') }}" 
                           class="p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-[#48C264] transition duration-300 flex items-center shadow-md">
                            <img src="{{ asset('images/icon-category-green.png') }}" alt="Ikon Buku" class="h-7 w-7 object-contain mr-5">
                            <div>
                                <h3 class="font-bold text-lg text-[#193053]">Tambah Kategori</h3>
                                <p class="text-sm text-gray-500">Buat, edit, atau hapus kategori.</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.courses.create') }}" 
                           class="p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-[#da5353] transition duration-300 flex items-center shadow-md">
                            <img src="{{ asset('images/icon-course-red.png') }}" alt="Ikon Buku" class="h-7 w-7 object-contain mr-5">
                            <div>
                                <h3 class="font-bold text-lg text-[#193053]">Tambah Kelas</h3>
                                <p class="text-sm text-gray-500">Edit, publikasikan, atau arsipkan.</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.users.create') }}" 
                           class="p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-[#446AA6] transition duration-300 flex items-center shadow-md">
                            <img src="{{ asset('images/icon-user-biru.png') }}" alt="Ikon User" class="h-7 w-7 object-contain mr-5">
                            <div>
                                <h3 class="font-bold text-lg text-[#193053]">Tambah Pengguna</h3>
                                <p class="text-sm text-gray-500">Atur peran (Admin/Teacher/Student).</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('admin.contents.create') }}" 
                           class="p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-[#F4A03E] transition duration-300 flex items-center shadow-md">
                            <img src="{{ asset('images/icon-book-orange.png') }}" alt="Ikon Buku" class="h-7 w-7 object-contain mr-5">
                            <div>
                                <h3 class="font-bold text-lg text-[#193053]">Tambah Materi</h3>
                                <p class="text-sm text-gray-500">Atur seluruh konten dan aset kelas.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>