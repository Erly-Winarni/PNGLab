<aside class="w-64 min-h-screen bg-white text-gray-400 shadow-2xl flex flex-col">

    {{-- LOGO --}}
    <div class="p-4 ml-2 flex items-center">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <img src="{{ asset('images/Logo-PNGLab.png') }}" alt="Logo PNGLab" class="block h-10 w-auto">
            <span class="ml-2 text-xl font-semibold text-[#193053]">PNGLab</span>
        </a>
    </div>

    <nav class="mt-4 px-3 space-y-2 flex-grow">

        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-2 rounded-lg transition
            {{ request()->routeIs('dashboard') 
                || request()->routeIs('admin.dashboard') 
                || request()->routeIs('teacher.dashboard') 
                || request()->routeIs('student.dashboard')
                ? 'bg-[#446AA6] text-white' 
                : 'text-gray-400 hover:bg-gray-200 hover:text-[#193053]' }}">
            Dashboard
        </a>



        {{-- ========================================= --}}
        {{-- =============== STUDENT ================= --}}
        {{-- ========================================= --}}
        @if(auth()->user()->role === 'student')

            {{-- Kelas --}}
            <a href="{{ route('student.courses.catalog') }}"
               class="flex items-center px-4 py-2 rounded-lg transition
               {{ request()->routeIs('student.courses.*') ? 'bg-[#446AA6] text-white' : 'hover:bg-gray-200 hover:text-[#193053]' }}">
               Kelas
            </a>
        @endif


        {{-- ========================================= --}}
        {{-- =============== TEACHER ================= --}}
        {{-- ========================================= --}}
        @if(auth()->user()->role === 'teacher')

            {{-- KELAS --}}
            <a href="{{ route('teacher.courses.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition
               {{ request()->routeIs('teacher.courses.*') ? 'bg-[#446AA6] text-white' : 'text-gray-400 hover:bg-gray-200 hover:text-[#193053]' }}">
                Kelas
            </a>

            {{-- MATERI --}}
            <a href="{{ route('teacher.contents.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition
               {{ request()->routeIs('teacher.contents.*') ? 'bg-[#446AA6] text-white' : 'text-gray-400 hover:bg-gray-200 hover:text-[#193053]' }}">
                Materi
            </a>

        @endif


        {{-- ========================================= --}}
        {{-- =============== ADMIN =================== --}}
        {{-- ========================================= --}}
        @if(auth()->user()->role === 'admin')

            {{-- KELAS --}}
            <a href="{{ route('admin.courses.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition
               {{ request()->routeIs('admin.courses.*') ? 'bg-[#446AA6] text-white' : 'text-gray-400 hover:bg-gray-200 hover:text-[#193053]' }}">
                Kelas
            </a>

            {{-- MATERI --}}
            <a href="{{ route('admin.contents.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition
               {{ request()->routeIs('admin.contents.*') ? 'bg-[#446AA6] text-white' : 'text-gray-400 hover:bg-gray-200 hover:text-[#193053]' }}">
                Materi
            </a>

            {{-- PENGGUNA --}}
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition
               {{ request()->routeIs('admin.users.*') ? 'bg-[#446AA6] text-white' : 'text-gray-400 hover:bg-gray-200 hover:text-[#193053]' }}">
                Pengguna
            </a>

            {{-- KATEGORI --}}
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition
               {{ request()->routeIs('admin.categories.*') ? 'bg-[#446AA6] text-white' : 'text-gray-400 hover:bg-gray-200 hover:text-[#193053]' }}">
                Kategori
            </a>

        @endif


        {{-- PROFILE --}}
        <a href="{{ route('profile.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition
           {{ request()->routeIs('profile.*') ? 'bg-[#446AA6] text-white' : 'text-gray-400 hover:bg-gray-200 hover:text-[#193053]' }}">
            Profile
        </a>

    </nav>

    {{-- LOGOUT --}}
    <div class="px-3 pb-4 pt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left flex items-center px-4 py-2 rounded-lg text-gray-400 transition hover:bg-red-700 hover:text-[#193053]">
                Logout
            </button>
        </form>
    </div>

</aside>
