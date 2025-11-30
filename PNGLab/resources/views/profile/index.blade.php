<x-app-layout>
    @php
        $profilePhoto = $user->avatar 
            ? asset('storage/' . $user->avatar)
            : asset('images/profile-default.png'); 
    @endphp
    <div class="min-h-screen py-10"> 
        <h1 class="max-w-7xl mx-auto px-4 text-3xl ml-4 font-extrabold text-[#193053] mb-8">
            Profile Pengguna
        </h1>
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-28 md:space-x-12">
            <div class="md:col-span-1 lg:col-span-1 max-w-sm mx-auto w-full"> 
                <div class="relative w-[410px] p-12 mb-8 min-h-[500px]">
                    <img src="{{ asset('images/gantungan.png') }}" 
                         alt="Hiasan Gantungan ID Card" 
                         class="absolute top-12 left-[214px] transform -translate-x-1/2 -translate-y-full w-36 h-auto z-10">

                    <img src="{{ asset('images/frame-profile.png') }}" 
                        alt="Background ID Card" 
                        class="absolute inset-0 w-full h-full object-cover z-0">

                    <div class="relative z-20 flex flex-col items-center text-center pt-8 text-white">
                        <div class="relative w-24 h-24 p-1 rounded-full mb-3 bg-gradient-to-b from-[#446AA6] to-[#5ED68A]">
                            <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden border-4 border-gray-900">
                                    <img src="{{ $profilePhoto }}"
                                    class="w-full h-full object-cover rounded-full" 
                                    alt="Avatar Pengguna">
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
                        
                        <h2 class="text-xl font-bold leading-tight">{{ $user->name }}</h2>
                        <p class="text-sm font-light text-gray-200">{{ $user->email }}</p>
                        <p class="text-md font-bold text-[#193053] mt-1">{{ ucfirst($user->role) }}</p>


                        <div class="mt-5 w-3/4 mx-auto bg-gray-800 bg-opacity-50 p-2 rounded-full border border-gray-700">
                            <span class="tracking-widest text-lg">••••••••••</span>
                        </div>

                        <a href="{{ route('profile.password.edit') }}"
                        class="mt-3 px-4 py-1 bg-[#4670A4] text-white rounded-full text-sm font-semibold hover:bg-[#264069] transition">
                            Ganti Kata Sandi
                        </a>

                        <a href="{{ route('profile.edit') }}"
                        class="mt-3 text-sm px-4 py-1 bg-white text-[#193053] rounded-full font-semibold hover:bg-gray-300  hover:opacity-100 transition">
                            Edit Informasi Profil &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <div class="md:col-span-1 lg:col-span-2"> 
                <div class="relative w-full p-4 md:p-8 rounded-3xl shadow-2xl min-h-[500px] bg-white">
                    <h2 class="text-2xl font-bold mb-4 border-b pb-2 border-gray-600 text-[#193053] border-opacity-30">
                        @if ($user->role === 'student')
                            Kelas yang Diikuti 
                        @elseif ($user->role === 'teacher')
                            Kelas yang Diajar 
                        @elseif ($user->role === 'admin')
                            Statistik Platform 
                        @endif
                    </h2>
                    
                    @if ($user->role === 'student')
                        <div class="space-y-6">
                            @forelse ($courses as $course)
                                <div class="pb-3 border-b border-gray-300">
                                    <h3 class="text-lg font-bold">{{ $course->title }}</h3>
                                    <p class="text-sm text-gray-700">Pengajar: {{ $course->teacher->name }}</p>

                                    <div class="mt-2">
                                        <div class="w-full bg-[#CFCFCF] rounded-full h-3">
                                            <div class="bg-[#52A397] h-3 rounded-full"
                                                style="width: {{ $course->progress }}%"></div>
                                        </div>
                                        <p class="text-sm mt-1 text-gray-800">Progress: {{ $course->progress }}%</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-700">Belum mengikuti kursus apapun.</p>
                            @endforelse
                        </div>
                    @endif

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