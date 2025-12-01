<aside class="w-64 min-h-screen bg-white text-gray-400 shadow-2xl flex flex-col">
    <div class="p-4 ml-2 flex items-center">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('images/Logo-PNGLab.png') }}" alt="Logo PNGLab" class="block h-10 w-auto">
            <span class="ml-2 text-xl font-semibold text-[#193053]">PNGLab</span>
        </a>
    </div>

    @auth
        <div class="px-3 pb-4 pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left flex items-center px-4 py-2 rounded-lg text-gray-400 transition hover:bg-red-700 hover:text-[#193053]">
                    Logout
                </button>
            </form>
        </div>
    @endauth

    @guest
        <div class="px-3 pb-4 pt-4">
            <a href="{{ route('login') }}"
               class="w-full text-left flex items-center px-4 py-2 rounded-lg text-gray-400 transition hover:bg-gray-200 hover:text-[#193053]">
                Login
            </a>
        </div>
    @endguest

</aside>
