<nav class="fixed bottom-0 left-0 w-full bg-[#20232a] border-t border-gray-800 z-30 shadow-2xl">
    <div class="flex justify-around items-center h-16">

        {{-- Dashboard Link --}}
        <a href="{{ route('dashboard') }}"
           class="flex flex-col items-center justify-center p-2 text-xs transition duration-150 ease-in-out
           {{ request()->routeIs('dashboard') ? 'text-blue-500' : 'text-gray-400 hover:text-white' }}">
           
           Dashboard
        </a>

        {{-- Profile Link --}}
        <a href="{{ route('profile.index') }}"
           class="flex flex-col items-center justify-center p-2 text-xs transition duration-150 ease-in-out
           {{ request()->routeIs('profile.*') ? 'text-blue-500' : 'text-gray-400 hover:text-white' }}">
           

           Profile
        </a>
        
        {{-- Logout (Opsional: Tombol Logout jarang ditaruh di bottom nav) --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex flex-col items-center justify-center p-2 text-xs text-gray-400 hover:text-red-500 transition">
     
                Logout
            </button>
        </form>

    </div>
</nav>