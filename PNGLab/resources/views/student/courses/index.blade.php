<x-app-layout>
    <div class="flex flex-col min-h-full bg-[#EAF1FF] text-white">
        <div class="flex justify-between items-center px-6 py-4 sticky top-0 z-10">
            <div class="flex flex-col flex-shrink-0 -mt-6">
                <div class="flex items-center space-x-2"> 
                    <span class="text-3xl font-bold mt-12 ml-4 text-[#193053]">Semua Kelas</span>
                </div>
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

                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                <div x-show="open" @click.away="open = false" x-transition 
                     class="absolute right-0 mt-2 w-40 bg-white border rounded-xl shadow-lg py-2 z-50">
                    <a href="{{ route('profile.edit') }}" 
                       class="block px-4 py-2 text-sm text-[#193053] hover:bg-gray-200 transition">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full text-left px-4 py-2 text-sm text-[#193053] hover:bg-red-700 hover:text-white transition">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex flex-col p-6 space-y-10">
            <form action="{{ route('student.courses.catalog') }}" 
                method="GET" 
                class="flex items-center gap-2 p-1 mx-4 flex-grow max-w-xl">

                <div class="relative w-full"> 
                    <img src="{{ asset('images/PNGY-searchbar.PNG') }}" 
                         alt="Ikon Pencarian Penguin" 
                         class="absolute -left-2 top-[28px] transform -translate-y-1/2 h-auto w-[180px] z-10 pointer-events-none">

                    <input type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="    Cari kelas..."
                        class="border-none rounded-lg shadow-lg 
                            pl-12 py-3 text-[#193053] placeholder-gray-400 
                            focus:ring-blue-500 focus:bg-gray-200 w-full transition"> 
                </div>

                <button type="submit" 
                        class="bg-[#446AA6] text-white px-3 py-2 rounded-xl hover:bg-[#264069] transition flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                <select name="category" 
                        onchange="this.form.submit()"
                        class="border-none rounded-2xl px-4 py-2 bg-[#446AA6] hover:bg-[#264069] text-white
                                focus:ring-indigo-500 focus:bg-[#264069] transition hidden lg:block">
                    <option value="" {{ !request('category') ? 'selected' : '' }}>Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            <hr class="border-[#193053]">

            @if($courses->isEmpty())
                <p class="text-[#193053]">Tidak ada course yang ditemukan.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($courses as $course)
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
                                    @if(!$isFollowed)
                                        <form action="{{ route('student.courses.follow', $course->id) }}" method="POST">
                                            @csrf
                                            <button class="bg-[#4670A4] text-white px-4 py-2 rounded-2xl text-sm font-semibold hover:bg-[#264069] transition">
                                                Ikuti Kelas
                                            </button>
                                        </form>
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
                <div class="mt-6">
                    {{ $courses->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
