<x-app-layout>
    {{-- CATATAN: x-slot name="header" telah dihapus karena header diatur di app.blade.php --}}

    {{-- Container utama disederhanakan --}}
    <div class="p-6 space-y-10">

        {{-- ===================== --}}
        {{-- Search & Category Filter BARU (Menggunakan Dropdown) --}}
        {{-- ===================== --}}
        <div class="bg-[#2f333a] p-6 rounded-xl shadow-lg border border-gray-700">
            <h3 class="font-bold text-xl text-white mb-4">Cari Course dan Filter Kategori 🔎</h3>

            {{-- Form Filter Utama --}}
            <form action="{{ route('student.dashboard') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-4">
                
                {{-- Input Search --}}
                <input type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari course..." 
                    class="border-none rounded-full px-4 py-2 w-full md:w-72 
                        bg-gray-700 text-white placeholder-gray-400 focus:ring-blue-500 focus:bg-gray-800 transition">

                {{-- Tombol Cari (Jika ada input search) --}}
                <button type="submit" 
                        class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition w-full md:w-auto">
                    Cari
                </button>

                {{-- Dropdown Filter Category --}}
                <select name="category" 
                        id="category_filter" 
                        onchange="this.form.submit()" {{-- Ini akan memicu submit form saat nilai diubah --}}
                        class="border-none rounded-full px-4 py-2 
                            bg-gray-700 text-white focus:ring-indigo-500 focus:bg-gray-800 transition w-full md:w-auto">
                    
                    {{-- Opsi Default (Semua) --}}
                    <option value="" {{ !request('category') ? 'selected' : '' }}>
                        Semua Kategori
                    </option>

                    {{-- Loop Kategori --}}
                    @foreach($categories as $cat)
                        {{-- LOGIC DIBIARKAN SAMA: Memeriksa apakah ID kategori saat ini dipilih --}}
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                
                {{-- Input tersembunyi untuk mempertahankan nilai 'search' saat filter kategori diubah --}}
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                
            </form>

        </div>

        <hr class="border-gray-700">

        {{-- ===================== --}}
        {{-- POPULAR COURSES --}}
        {{-- ===================== --}}
        {{-- <div>
            <h3 class="font-bold text-2xl text-white mb-6">🔥 5 Course Terpopuler</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($popularCourses as $course)
                    <div class="bg-[#2f333a] rounded-xl shadow-lg p-6 flex flex-col justify-between 
                                transform hover:scale-[1.02] transition duration-300 ease-in-out border border-gray-700"> --}}

                        {{-- Course Info --}}
                        {{-- <div>
                            <h4 class="font-extrabold text-xl text-white">{{ $course->title }}</h4>

                            <p class="text-indigo-400 text-sm font-medium mt-1">
                                Teacher: {{ $course->teacher->name }}
                            </p>

                            <p class="text-gray-400 text-sm mt-3">
                                {{ Str::limit($course->description, 120) }}
                            </p>
                        </div> --}}

                        {{-- Action Section --}}
                        {{-- <div class="mt-5 pt-4 border-t border-gray-700">

                            @php
                                $isFollowed = $user->courses->contains($course->id);
                                $progress = $course->progressFor($user);
                            @endphp --}}

                            {{-- Progress --}}
                            {{-- @if($isFollowed) --}}
                                {{-- LOGIC DIBIARKAN SAMA --}}
                                {{-- <div class="mb-4">
                                    <div class="w-full bg-gray-700 rounded-full h-3">
                                        <div class="bg-green-500 h-3 rounded-full" 
                                            style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                    <p class="text-sm mt-2 text-green-400 font-semibold">{{ $progress }}% progress</p>
                                </div>
                            @endif --}}

                            {{-- Buttons --}}
                            {{-- <div class="flex justify-start"> --}}

                                {{-- Follow (LOGIC DIBIARKAN SAMA) --}}
                                {{-- @if(!$isFollowed)
                                    <form action="{{ route('student.courses.follow', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-blue-700 transition">
                                            Ikuti Course &rarr;
                                        </button>
                                    </form>
                                @else --}}
                                    {{-- Already Followed: View Material (LOGIC DIBIARKAN SAMA) --}}
                                    {{-- <a href="{{ route('student.courses.show', $course->slug) }}"
                                       class="bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-indigo-700 transition">
                                        Lanjut Materi ({{ $progress }}%)
                                    </a>
                                @endif

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div> --}}
        
        {{-- <hr class="border-gray-700"> --}}

        {{-- ===================== --}}
        {{-- ALL COURSES LIST --}}
        {{-- ===================== --}}
        <div>
            <h3 class="font-bold text-2xl text-white mb-6">Semua Course</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($courses as $course)
                    <div class="bg-[#2f333a] rounded-xl shadow-lg p-6 flex flex-col justify-between 
                                transform hover:scale-[1.02] transition duration-300 ease-in-out border border-gray-700">

                        {{-- Course Info --}}
                        <div>
                            <h4 class="font-extrabold text-xl text-white">{{ $course->title }}</h4>
                            <p class="text-indigo-400 text-sm font-medium mt-1">Teacher: {{ $course->teacher->name }}</p>

                            <p class="text-gray-400 text-sm mt-3 mb-4">
                                {{ Str::limit($course->description, 120) }}
                            </p>
                        </div>

                        {{-- Action Section --}}
                        <div class="mt-auto pt-4 border-t border-gray-700">
                            
                            @php
                                $isFollowed = $user->courses->contains($course->id);
                                $progress = $course->progressFor($user);
                            @endphp

                            {{-- Progress --}}
                            @if($isFollowed)
                                {{-- LOGIC DIBIARKAN SAMA --}}
                                <div class="mb-4">
                                    <div class="w-full bg-gray-700 rounded-full h-3">
                                        <div class="bg-green-500 h-3 rounded-full" 
                                            style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                    <p class="text-sm mt-2 text-green-400 font-semibold">{{ $progress }}% selesai</p>
                                </div>
                            @endif

                            {{-- Buttons --}}
                            <div class="flex justify-start">
                                {{-- Follow (LOGIC DIBIARKAN SAMA) --}}
                                @if(!$isFollowed)
                                    <form action="{{ route('student.courses.follow', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-blue-700 transition">
                                            Ikuti Course &rarr;
                                        </button>
                                    </form>
                                @else
                                    {{-- View Material (LOGIC DIBIARKAN SAMA) --}}
                                    <a href="{{ route('student.courses.show', $course->slug) }}"
                                       class="bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-indigo-700 transition">
                                        Lihat Materi
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>

    </div>
</x-app-layout>