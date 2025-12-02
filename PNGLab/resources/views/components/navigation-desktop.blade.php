<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="sm:hidden p-2 m-2 rounded bg-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <aside
        :class="{'translate-x-0': open, '-translate-x-full': !open }"
        class="fixed top-0 left-0 w-64 h-full bg-white text-gray-400 rounded-2xl flex flex-col
               transform -translate-x-full transition-transform duration-300 ease-in-out
               sm:translate-x-0 sm:static sm:h-[1000px] z-50">
               
        <div class="p-4 ml-2 flex items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('images/Logo-PNGLab.png') }}" alt="Logo PNGLab" class="block h-10 w-auto">
                <span class="ml-2 text-xl font-semibold text-[#193053]">PNGLab</span>
            </a>
        </div>

        <nav class="mt-4 px-3 space-y-2 flex-grow">
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3
                {{ request()->routeIs(['dashboard', 'admin.dashboard', 'teacher.dashboard', 'student.dashboard'])
                    ? 'bg-[#446AA6] text-white' 
                    : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                
                <img src="{{ asset('images/icon-home.png') }}" alt="Ikon Dashboard" class="w-5 h-5 object-contain transition
                    {{ request()->routeIs(['dashboard', 'admin.dashboard', 'teacher.dashboard', 'student.dashboard']) ? '' : 'filter grayscale contrast-50 opacity-80' }}">
                    
                <span>Dashboard</span>
            </a>

            @if(auth()->user()->role === 'student')
                <a href="{{ route('student.courses.catalog') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3
                {{ request()->routeIs('student.courses.*') ? 'bg-[#446AA6] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                    
                    <img src="{{ asset('images/icon-course.png') }}" alt="Ikon Kelas" class="w-5 h-5 object-contain transition
                        {{ request()->routeIs('student.courses.*') ? '' : 'filter grayscale contrast-50 opacity-80' }}">
                        
                    <span>Kelas</span>
                </a>
            @endif

            @if(auth()->user()->role === 'teacher')
                <a href="{{ route('teacher.courses.index') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3
                {{ request()->routeIs('teacher.courses.*') ? 'bg-[#446AA6] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                    
                    <img src="{{ asset('images/icon-course.png') }}" alt="Ikon Kelas" class="w-5 h-5 object-contain transition
                        {{ request()->routeIs('teacher.courses.*') ? '' : 'filter grayscale contrast-50 opacity-80' }}">

                    <span>Kelas</span>
                </a>

                <a href="{{ route('teacher.contents.index') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3
                {{ request()->routeIs('teacher.contents.*') ? 'bg-[#446AA6] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                    
                    <img src="{{ asset('images/icon-book.png') }}" alt="Ikon Materi" class="w-5 h-5 object-contain transition
                        {{ request()->routeIs('teacher.contents.*') ? '' : 'filter grayscale contrast-50 opacity-80' }}">

                    <span>Materi</span>
                </a>

            @endif

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.courses.index') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3
                {{ request()->routeIs('admin.courses.*') ? 'bg-[#446AA6] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                    
                    <img src="{{ asset('images/icon-course.png') }}" alt="Ikon Kelas" class="w-5 h-5 object-contain transition
                        {{ request()->routeIs('admin.courses.*') ? '' : 'filter grayscale contrast-50 opacity-80' }}">

                    <span>Kelas</span>
                </a>

                <a href="{{ route('admin.contents.index') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3
                {{ request()->routeIs('admin.contents.*') ? 'bg-[#446AA6] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                    
                    <img src="{{ asset('images/icon-book.png') }}" alt="Ikon Materi" class="w-5 h-5 object-contain transition
                        {{ request()->routeIs('admin.contents.*') ? '' : 'filter grayscale contrast-50 opacity-80' }}">

                    <span>Materi</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3
                {{ request()->routeIs('admin.users.*') ? 'bg-[#446AA6] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                    
                    <img src="{{ asset('images/icon-user.png') }}" alt="Ikon Pengguna" class="w-5 h-5 object-contain transition
                        {{ request()->routeIs('admin.users.*') ? '' : 'filter grayscale contrast-50 opacity-80' }}">

                    <span>Pengguna</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3
                {{ request()->routeIs('admin.categories.*') ? 'bg-[#446AA6] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                    
                    <img src="{{ asset('images/icon-category.png') }}" alt="Ikon Kategori" class="w-5 h-5 object-contain transition
                        {{ request()->routeIs('admin.categories.*') ? '' : 'filter grayscale contrast-50 opacity-80' }}">

                    <span>Kategori</span>
                </a>

            @endif

            <a href="{{ route('profile.index') }}"
                class="flex items-center px-4 py-2 rounded-lg transition space-x-3 
                {{ request()->routeIs('profile.*') ? 'bg-[#446AA6] text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-[#193053]' }}">
                
                <img src="{{ asset('images/icon-profile.png') }}" alt="Ikon Profile" class="w-5 h-5 object-contain transition
                    {{ request()->routeIs('profile.*') ? '' : 'filter grayscale contrast-50 opacity-80' }}">
                
                <span>Profile</span>
            </a>
        </nav>

        <div class="px-3 pb-4 pt-4 relative">
            <div class="absolute inset-x-0 bottom-full flex justify-center -mb-[117px]"> 
                <img src="{{ asset('images/PNGY-bye.PNG') }}" alt="Ilustrasi Sampai Jumpa" class="h-auto w-72 object-contain pointer-events-none z-20"> 
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center justify-center space-x-3 px-4 py-3 rounded-xl bg-[#446AA6] text-white font-semibold text-lg hover:bg-red-600 transition shadow-md relative z-10"> 
                    <img src="{{ asset('images/icon-logout.png') }}" alt="Ikon Keluar" class="h-6 w-6 object-contain">
                    <span>Keluar</span>   
                </button>
            </form>
        </div>
    </aside>

    <div x-show="open" @click="open = false"
         class="fixed inset-0 bg-black bg-opacity-30 sm:hidden"></div>
</div>
