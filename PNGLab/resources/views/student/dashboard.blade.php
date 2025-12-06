<x-app-layout>
    <div class="flex flex-col min-h-full bg-[#EAF1FF] text-white"> 
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
                    class="flex items-center space-x-3 bg-white p-2 rounded-full 
                            cursor-pointer hover:bg-gray-200 transition">
                    
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

        <div class="flex flex-col md:flex-row flex-1"> 
            <div class="flex-1 p-6 overflow-y-auto space-y-10">
                <form action="{{ route('student.dashboard') }}" 
                    method="GET" 
                    class="items-center gap-2 p-1 mx-4 flex-grow max-w-xl flex">
                    <div class="relative w-full"> 
                        <img src="{{ asset('images/PNGY-searchbar.PNG') }}" alt="Ikon Pencarian Penguin" class="absolute -left-2 top-[28px] transform -translate-y-1/2 h-auto w-[180px] z-10 pointer-events-none">
                        
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="    Cari kelas..."
                            class="border-none rounded-lg shadow-lg pl-12 py-3 text-[#193053] placeholder-gray-400 focus:ring-blue-500 focus:bg-gray-200 w-full transition"> 
                        </div>
                    <button type="submit" 
                            class="bg-[#446AA6] text-white px-3 py-2 rounded-xl hover:bg-[#264069] transition flex-shrink-0">
                        <img src="{{ asset('images/icon-search.png') }}" alt="Ikon Pencarian" class="h-5 w-5 object-contain">
                    </button>

                    <select name="category" 
                            id="category_filter_top"
                            onchange="this.form.submit()"
                            class="border-none rounded-2xl px-4 py-2 bg-[#446AA6] hover:bg-[#264069] text-white focus:ring-indigo-500 focus:bg-[#264069] transition hidden lg:block flex-shrink-0">
                        <option value="" {{ !request('category') ? 'selected' : '' }}>Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" 
                                {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <div class="relative bg-gradient-to-r from-[#446AA6] to-[#5ED68A] rounded-3xl p-10 shadow-xl">
                    <div class="absolute inset-0 opacity-10 rounded-3xl"></div>
                    <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <div>
                            <h2 class="font-medium text-4xl mb-2 leading-tight">
                                Temukan Kelas Desain yang Cocok Untuk <strong>Kamu</strong>
                            </h2>
                            <p class="font-medium italic mb-4">
                                Kembangkan kemampuan desainmu dengan materi yang mudah diikuti
                            </p>
                            <a href="{{ route('student.courses.catalog') }}" class="inline-flex items-center px-6 py-3 bg-white text-[#193053] font-bold rounded-full hover:bg-gray-300 transition">
                                Jelajahi Kelas &rarr;
                            </a>
                        </div>
                    </div>

                    <div class="hidden md:block"> 
                        <img src="{{ asset('images/PNGY-dash-shadow.png') }}" 
                            alt="Ilustrasi PNGY" class="absolute h-auto w-[650px] bottom-24 -right-20 z-20 transform translate-y-1/4 pointer-events-none"> 
                    </div>
                </div>

                <hr class="border-[#193053]">

                <div class="-pt-2">
                    <h3 class="font-bold text-2xl mb-6 text-[#193053]">Semua Kelas</h3>
                    
                    @if($courses->isEmpty())
                        <p class="text-[#193053]">Tidak ada course yang tersedia saat ini.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($topCourses as $course)
                            
                                @php
                                    $isFollowed = Auth::user()->courses->contains($course->id);
                                    $progress = method_exists($course, 'progressFor') 
                                                ? $course->progressFor(Auth::user()) 
                                                : 0;
                                @endphp

                                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col">
                                    <div class="mb-4 text-[#193053]">
                                        <h4 class="font-extrabold text-xl">{{ $course->title }}</h4>
                                        <p class="text-sm mt-1">
                                            Oleh: {{ $course->teacher->name }}
                                        </p>
                                        <p class="text-[#193053] text-sm mt-3">
                                            {{ Str::limit($course->description, 120) }}
                                        </p>
                                    </div>

                                    <div class="mt-auto pt-4 border-t border-gray-300">
                                        
                                        @if($isFollowed)
                                            <div class="mb-4">
                                                <div class="w-full bg-[#CFCFCF] rounded-full h-2">
                                                    <div class="bg-[#52A397] h-2 rounded-full" 
                                                        style="width: {{ $progress }}%"></div>
                                                </div>
                                                <p class="text-xs mt-2 text-[#193053] text-right">{{ $progress }}% selesai</p>
                                            </div>
                                        @endif

                                        <div class="flex gap-2 justify-between items-center">
                                            @php
                                                $isFull = $course->max_students && $course->students()->count() >= $course->max_students;
                                            @endphp

                                            @if(!$isFollowed)
                                                @if($isFull)
                                                    <div class="text-red-600 text-xs font-semibold mb-2">
                                                        Kelas ini sudah penuh
                                                    </div>

                                                    <button class="bg-gray-400 text-white px-4 py-2 rounded-2xl text-sm font-semibold cursor-not-allowed"
                                                            disabled>
                                                        Kelas Penuh
                                                    </button>
                                                @else
                                                    <form action="{{ route('student.courses.follow', $course->id) }}" method="POST">
                                                        @csrf
                                                        <button class="bg-[#4670A4] text-white px-4 py-2 rounded-2xl text-sm font-semibold hover:bg-[#264069] transition">
                                                            Ikuti Kelas
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <a href="{{ route('student.courses.show', $course->slug) }}"
                                                   class="bg-[#4670A4] text-white px-4 py-2 rounded-2xl text-sm font-semibold hover:bg-[#264069] transition">
                                                    Lihat Materi
                                                </a>
                                            @endif

                                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $course->teacher->email }}&su=Pertanyaan tentang Course: {{ urlencode($course->title) }}"
                                                target="_blank"
                                                class="bg-[#48C264] text-white px-4 py-2 rounded-2xl text-sm font-semibold hover:bg-green-700 transition">
                                                Hubungi Guru
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            <aside class="w-full md:w-80 flex-shrink-0 p-6 mt-5 mb-10 mr-5 mx-auto bg-white shadow-lg overflow-y-auto rounded-3xl">
                <h3 class="font-bold text-xl mb-6 text-[#193053]">Kelas yang Diikuti:</h3>
                
                <div class="space-y-4">
                    
                    @php
                        $followedCourses = Auth::user()->courses()
                            ->with('teacher')
                            ->withCount('contents')
                            ->get();
                    @endphp

                    @forelse($followedCourses as $course)
                        @php
                            $progress = method_exists($course, 'progressFor') 
                                ? $course->progressFor(Auth::user()) 
                                : 0;
                        @endphp

                        <a href="{{ route('student.courses.show', $course->slug) }}" class="block">
                            <div class="bg-[#446AA6] rounded-xl p-4 hover:bg-[#264069] transition">
                                <h4 class="font-semibold truncate">{{ $course->title }}</h4>
                                <p class="text-xs mb-2">Oleh: {{ $course->teacher->name }}</p>

                                <div class="flex items-center mt-2">
                                    <div class="w-full bg-white rounded-full h-2">
                                        <div class="bg-[#52A397] h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <span class="text-xs ml-2">{{ $progress }}%</span>
                                </div>
                            </div>
                        </a>

                    @empty
                        <p class="text-sm text-gray-400">Kamu belum mengikuti kelas apapun.</p>
                    @endforelse

                </div>
            </aside>
        </div>
    </div>
</x-app-layout>