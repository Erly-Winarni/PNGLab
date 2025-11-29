<aside class="w-64 min-h-screen bg-white text-gray-400 shadow-2xl">

    <div class="p-4 ml-2 flex items-center">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            
            <img src="{{ asset('images/Logo-PNGLab.png') }}" 
                alt="Logo PNGLab" 
                class="block h-10 w-auto">
            
            <span class="ml-2 text-xl font-semibold text-[#193053]">PNGLab</span>
        </a>
    </div>

    <nav class="mt-4 px-3 space-y-2">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
        class="flex items-center px-4 py-2 rounded-lg transition
        {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
        Dashboard
        </a>

        {{-- KELAS (Student / Teacher / Admin) --}}
        @if(auth()->user()->role === 'student')
            <a href="{{ route('student.courses.catalog') }}"
            class="flex items-center px-4 py-2 rounded-lg transition
            {{ request()->routeIs('student.courses.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                Kelas
            </a>
        @endif

        @if(auth()->user()->role === 'teacher')
            <a href="{{ route('teacher.courses.index') }}"
            class="flex items-center px-4 py-2 rounded-lg transition
            {{ request()->routeIs('teacher.courses.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                Kelas
            </a>
        @endif

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.courses.index') }}"
            class="flex items-center px-4 py-2 rounded-lg transition
            {{ request()->routeIs('admin.courses.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                Kelas
            </a>
        @endif


        {{-- Profile --}}
        <a href="{{ route('profile.index') }}"
        class="flex items-center px-4 py-2 rounded-lg transition
        {{ request()->routeIs('profile.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
        Profile
        </a>

        {{-- Logout --}}
        <div class="px-3 pb-4 flex flex-col items-center">
            <img src="{{ asset('images/PNGY-bye.PNG') }}" alt="Ikon Dadah" class="h-auto w-[800px] mt-[430px] object-contain">
            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left flex items-center px-4 pb-2 pt-10 rounded-lg bg-[#CBD2E3] text-gray-400 transition hover:bg-red-700 hover:text-white mt-[520px]">
                    Logout
                </button>
            </form> --}}
        </div>
    </nav>

</aside>