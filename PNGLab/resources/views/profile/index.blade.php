<x-app-layout>
    <div class="min-h-screen py-10"> 
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Kolom 1: Kartu Informasi Pengguna (ID Card) --}}
            <div class="md:col-span-1 lg:col-span-1 max-w-sm mx-auto w-full"> 
                
                {{-- 1. Kartu Informasi Pengguna (Identitas) --}}
                <div class="relative w-full p-6 rounded-3xl shadow-2xl overflow-hidden mb-8 min-h-[450px]">
                    
                    {{-- BACKGROUND IMAGE (Menggantikan style background-image CSS) --}}
                    <img src="{{ asset('images/id-card2.png') }}" 
                        alt="Background ID Card" 
                        class="absolute inset-0 w-full h-full object-cover z-0">
                    
                    {{-- Konten Kartu (Lapisan Paling Atas) --}}
                    <div class="relative z-20 flex flex-col items-center text-center pt-8 text-white">

                        {{-- === Detail Avatar (Dengan Gradient Stroke & Tombol Edit) === --}}
                        <div class="relative w-24 h-24 p-1 rounded-full mb-3"
                            style="background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);">
                            
                            <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden border-4 border-gray-900">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}"
                                        class="w-full h-full object-cover rounded-full" alt="Avatar">
                                @else
                                    <div class="w-full h-full bg-blue-600 rounded-full flex items-center justify-center">
                                        <span class="text-3xl font-bold text-white">{{ substr($user->name, 0, 1) ?? 'G' }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <a href="{{ route('profile.edit') }}"
                            class="absolute bottom-0 right-0 transform translate-x-1 translate-y-1 
                                    w-6 h-6 bg-white rounded-full flex items-center justify-center 
                                    shadow-lg border border-gray-300 hover:bg-gray-100 transition">
                                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.218A2 2 0 0110.437 3h3.125a2 2 0 011.664.89l.812 1.218a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </a>
                        </div>
                        {{-- === END Detail Avatar === --}}
                        
                        {{-- Nama & Email --}}
                        <h2 class="text-xl font-bold leading-tight">{{ $user->name }}</h2>
                        <p class="text-sm font-light text-gray-200">{{ $user->email }}</p>
                        <p class="text-xs font-medium text-blue-300 mt-1">{{ ucfirst($user->role) }}</p>


                        {{-- Tombol Ganti Kata Sandi (Simulasi Teks Password) --}}
                        <div class="mt-5 w-3/4 mx-auto bg-gray-800 bg-opacity-50 p-2 rounded-full border border-gray-700">
                            <span class="tracking-widest text-lg">••••••••••</span>
                        </div>

                        {{-- Link Edit Password --}}
                        <a href="{{ route('profile.password.edit') }}"
                        class="mt-3 px-4 py-1 bg-blue-600 text-white rounded-full text-sm font-semibold hover:bg-blue-700 transition">
                            Ganti Kata Sandi
                        </a>

                        {{-- Link Edit Profil --}}
                        <a href="{{ route('profile.edit') }}"
                        class="mt-3 text-xs text-white opacity-70 hover:opacity-100 transition">
                            Edit Informasi Profil &rarr;
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kolom 2: Kartu Informasi Tambahan (Ini akan memakan 1 atau 2 kolom sisa) --}}
            <div class="md:col-span-1 lg:col-span-2"> 
                {{-- 2. Kartu Informasi Tambahan (Kartu Gradien Besar) --}}
                <div class="relative w-full p-6 md:p-8 rounded-3xl shadow-2xl min-h-[450px]"
                    style="
                        background: linear-gradient(135deg, #ffc837 0%, #ff8008 100%);
                        color: #333; 
                    ">
                    
                    {{-- JUDUL Kartu Tambahan --}}
                    <h2 class="text-2xl font-bold mb-4 border-b pb-2 border-gray-600 border-opacity-30">
                        @if ($user->role === 'student')
                            Kursus yang Diikuti 🎓
                        @elseif ($user->role === 'teacher')
                            Kursus yang Diajar 📚
                        @elseif ($user->role === 'admin')
                            Statistik Platform 📊
                        @endif
                    </h2>
                    
                    {{-- Konten Role (LOGIC TIDAK DIUBAH) --}}

                    {{-- Student --}}
                    @if ($user->role === 'student')
                        <div class="space-y-6">
                            @forelse ($courses as $course)
                                <div class="pb-3 border-b border-gray-300">
                                    <h3 class="text-lg font-bold">{{ $course->title }}</h3>
                                    <p class="text-sm text-gray-700">Pengajar: {{ $course->teacher->name }}</p>

                                    <div class="mt-2">
                                        <div class="w-full bg-yellow-200 rounded-full h-3">
                                            <div class="bg-green-600 h-3 rounded-full"
                                                style="width: {{ $course->progress }}%"></div>
                                        </div>
                                        <p class="text-sm mt-1 text-gray-800">Progress: **{{ $course->progress }}%**</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-700">Belum mengikuti kursus apapun.</p>
                            @endforelse
                        </div>
                    @endif

                    {{-- Teacher --}}
                    @if ($user->role === 'teacher')
                        <div class="space-y-6">
                            @forelse ($courses as $course)
                                <div class="pb-3 border-b border-gray-300">
                                    <h3 class="text-lg font-bold">{{ $course->title }}</h3>
                                    <p>Kategori: {{ $course->category->name }}</p>
                                    <p>**Jumlah Student:** {{ $course->students_count }}</p>
                                </div>
                            @empty
                                <p class="text-gray-700">Belum membuat kursus apapun.</p>
                            @endforelse
                        </div>
                    @endif

                    {{-- Admin --}}
                    @if ($user->role === 'admin')
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-4 rounded-xl shadow-md text-center">
                                <p class="text-3xl font-extrabold text-blue-600">{{ $totalUsers }}</p>
                                <p class="text-gray-600 text-sm">Total Users</p>
                            </div>

                            <div class="bg-white p-4 rounded-xl shadow-md text-center">
                                <p class="text-3xl font-extrabold text-green-600">{{ $totalStudents }}</p>
                                <p class="text-gray-600 text-sm">Students</p>
                            </div>

                            <div class="bg-white p-4 rounded-xl shadow-md text-center">
                                <p class="text-3xl font-extrabold text-yellow-600">{{ $totalTeachers }}</p>
                                <p class="text-gray-600 text-sm">Teachers</p>
                            </div>

                            <div class="bg-white p-4 rounded-xl shadow-md text-center">
                                <p class="text-3xl font-extrabold text-red-600">{{ $totalCourses }}</p>
                                <p class="text-gray-600 text-sm">Courses</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>