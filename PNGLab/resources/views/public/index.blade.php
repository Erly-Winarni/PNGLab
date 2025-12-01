<x-guest-layout>
    <div class="flex flex-col min-h-full bg-[#EAF1FF] text-white">

        {{-- ===== HEADER ===== --}}
        <div class="flex justify-between items-center px-6 py-4 sticky top-0 z-10">
            <div class="flex flex-col flex-shrink-0 -mt-6">
                <div class="flex items-center space-x-2">
                    <span class="text-xl font-medium text-[#193053]">Selamat Datang</span>
                    <img src="{{ asset('images/PNGY-hello.PNG') }}"
                         class="h-20 w-20 object-contain">
                </div>
                <span class="text-xl font-semibold text-[#193053] -mt-7">
                    Pengunjung
                </span>
            </div>

            {{-- ===== LOGIN BUTTON UNTUK GUEST ===== --}}
            <div class="flex items-center">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 bg-white text-[#193053] rounded-xl font-semibold shadow hover:bg-gray-200 transition">
                    Login
                </a>
            </div>
        </div>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="flex flex-col flex-1 p-6 space-y-10">

            {{-- ===== SEARCH BAR ===== --}}
            <form action="{{ route('home') }}" method="GET"
                  class="items-center gap-2 p-1 mx-4 flex-grow max-w-xl flex">

                <div class="relative w-full">
                    <img src="{{ asset('images/PNGY-searchbar.PNG') }}"
                         class="absolute -left-2 top-[28px] transform -translate-y-1/2 h-auto w-[180px]">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="    Cari kelas..."
                           class="border-none rounded-lg shadow-lg pl-12 py-3 text-[#193053] placeholder-gray-400
                                  focus:ring-blue-500 focus:bg-gray-200 w-full transition">
                </div>

                <button type="submit"
                        class="bg-[#446AA6] text-white px-3 py-2 rounded-xl hover:bg-[#264069] transition flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                <select name="category"
                        onchange="this.form.submit()"
                        class="border-none rounded-2xl px-4 py-2 bg-[#446AA6] hover:bg-[#264069] text-white hidden lg:block">
                    <option value="">Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

            </form>

            <div class="relative bg-gradient-to-r from-[#446AA6] to-[#5ED68A] rounded-3xl p-10 shadow-xl">
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <div>
                        <h2 class="font-medium text-4xl mb-2 text-white leading-tight">
                            Temukan Kelas Desain Terbaik di <strong>PNGLab!</strong>
                        </h2>
                        <p class="font-medium italic mb-4 text-white">
                            Bergabung dan belajar bersama ribuan siswa lainnya.
                        </p>

                        <a href="{{ route('login') }}"
                           class="inline-flex items-center px-6 py-3 bg-white text-[#193053] font-bold
                                  rounded-full hover:bg-gray-300 transition">
                            Login untuk Belajar →
                        </a>
                    </div>
                </div>

                <div class="hidden md:block">
                    <img src="{{ asset('images/PNGY-dash-shadow.png') }}"
                         class="absolute h-auto w-[650px] -bottom-5 -right-1 z-20 pointer-events-none">
                </div>
            </div>

            <hr class="border-[#193053]">

            <div class="pt-2">
                <h3 class="font-bold text-2xl mb-6 text-[#193053]">Kelas Populer</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($topCourses as $course)
                        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col">

                            <div class="mb-4 text-[#193053]">
                                <h4 class="font-extrabold text-xl">{{ $course->title }}</h4>
                                <p class="text-sm mt-1">Oleh: {{ $course->teacher->name }}</p>
                                <p class="text-sm mt-3">{{ Str::limit($course->description, 120) }}</p>
                            </div>

                            <div class="mt-auto pt-4 border-t border-gray-300">
                                <a href="{{ route('login') }}"
                                   class="bg-[#4670A4] text-white px-4 py-2 rounded-2xl text-sm font-semibold hover:bg-[#264069] transition w-full block text-center">
                                    Login untuk Mengakses
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
