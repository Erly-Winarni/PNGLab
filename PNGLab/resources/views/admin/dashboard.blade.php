<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Admin Dashboard') }} 👑
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <p class="mt-3 text-gray-400 text-lg mb-6">Selamat datang, Admin PNGLab! Kelola platform Anda dengan cepat.</p>

            {{-- ===================== --}}
            {{-- 1. Statistik Utama (Placeholder/Jika ada data) --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                
                {{-- Card Placeholder: Total Users --}}
                <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700 hover:scale-[1.03] transition duration-300">
                    <h3 class="text-sm font-medium text-gray-400">Total Pengguna</h3>
                    <p class="mt-1 text-3xl font-extrabold text-blue-500">999+</p>
                    <span class="text-xs text-green-400">↑ 15% dari bulan lalu</span>
                </div>

                {{-- Card Placeholder: Total Courses --}}
                <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700 hover:scale-[1.03] transition duration-300">
                    <h3 class="text-sm font-medium text-gray-400">Total Course</h3>
                    <p class="mt-1 text-3xl font-extrabold text-purple-500">120</p>
                    <span class="text-xs text-yellow-400">~ 20 Draft</span>
                </div>
                
                {{-- Card Placeholder: Total Teachers --}}
                <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700 hover:scale-[1.03] transition duration-300">
                    <h3 class="text-sm font-medium text-gray-400">Pengajar Aktif</h3>
                    <p class="mt-1 text-3xl font-extrabold text-green-500">15</p>
                    <span class="text-xs text-gray-400">Kelola via Manage Users</span>
                </div>

                 {{-- Card Placeholder: Categories --}}
                <div class="bg-[#2f333a] p-6 rounded-xl shadow-xl border border-gray-700 hover:scale-[1.03] transition duration-300">
                    <h3 class="text-sm font-medium text-gray-400">Kategori Total</h3>
                    <p class="mt-1 text-3xl font-extrabold text-indigo-500">24</p>
                    <span class="text-xs text-gray-400">Semua Course terklasifikasi</span>
                </div>
            </div>

            {{-- ===================== --}}
            {{-- 2. Navigasi Aksi Cepat (Quick Actions) --}}
            {{-- ===================== --}}
            <div class="border-t border-gray-700 pt-8">
                <h2 class="text-2xl font-bold text-white mb-4">Aksi Administrasi Cepat</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    
                    {{-- Manage Categories --}}
                    <a href="{{ route('admin.categories.index') }}" 
                       class="p-6 bg-[#2f333a] shadow-xl rounded-xl border border-gray-700 hover:border-blue-500 transition duration-300 hover:bg-[#393d45]">
                        <div class="text-blue-500 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2H7a2 2 0 00-2 2v2m7-8v14"></path></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Kelola Kategori</h3>
                        <p class="text-sm text-gray-400 mt-1">Buat, edit, dan hapus klasifikasi course.</p>
                    </a>

                    {{-- Manage Courses --}}
                    <a href="{{ route('admin.courses.index') }}" 
                       class="p-6 bg-[#2f333a] shadow-xl rounded-xl border border-gray-700 hover:border-purple-500 transition duration-300 hover:bg-[#393d45]">
                        <div class="text-purple-500 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.206 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.794 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.794 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.206 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Kelola Course</h3>
                        <p class="text-sm text-gray-400 mt-1">Edit, terbitkan, atau arsipkan course.</p>
                    </a>

                    {{-- Manage Users --}}
                    <a href="{{ route('admin.users.index') }}" 
                       class="p-6 bg-[#2f333a] shadow-xl rounded-xl border border-gray-700 hover:border-green-500 transition duration-300 hover:bg-[#393d45]">
                        <div class="text-green-500 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.656-.126-1.283-.356-1.857m-9.066.012A3 3 0 005 18v2H3v-2a3 3 0 013-3 3.003 3.003 0 011.085-.224m-1.085 0a3.003 3.003 0 01-1.085.224M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Kelola Pengguna</h3>
                        <p class="text-sm text-gray-400 mt-1">Atur peran (Admin/Teacher/Student).</p>
                    </a>
                    
                    {{-- Manage Content --}}
                    <a href="{{ route('admin.contents.index') }}" 
                       class="p-6 bg-[#2f333a] shadow-xl rounded-xl border border-gray-700 hover:border-yellow-500 transition duration-300 hover:bg-[#393d45]">
                        <div class="text-yellow-500 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-1.5m0 0v-2.5m0 2.5h2.5m-2.5 0H7.5m10 0v-1.5m0 0v-2.5m0 2.5h2.5m-2.5 0H17.5M12 12V6m0 6l-4 4m4-4l4 4"></path></svg>
                        </div>
                        <h3 class="font-bold text-lg text-white">Kelola Materi</h3>
                        <p class="text-sm text-gray-400 mt-1">Atur seluruh konten dan aset course.</p>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>