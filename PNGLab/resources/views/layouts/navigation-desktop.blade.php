{{-- Ganti layouts/navigation.blade.php Anda dengan kode ini --}}
<aside class="w-64 min-h-screen bg-[#20232a] text-gray-400 border-r border-gray-800 shadow-xl">

    {{-- Logo --}}
    <div class="p-4 flex items-center border-b border-gray-800">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <x-application-logo class="block h-10 w-auto text-white" />
            <span class="ml-2 text-xl font-semibold text-white">App Name</span>
        </a>
    </div>

    {{-- Menu --}}
    <nav class="mt-4 px-3 space-y-2">
        
        {{-- Dashboard Link --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 rounded-lg transition duration-150 ease-in-out
           {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
           
           Dashboard
        </a>

        {{-- Profile Link --}}
        <a href="{{ route('profile.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition duration-150 ease-in-out
           {{ request()->routeIs('profile.*') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">

           Profile
        </a>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left flex items-center px-4 py-2 rounded-lg text-gray-400 transition duration-150 ease-in-out hover:bg-red-700 hover:text-white mt-8">

                Logout
            </button>
        </form>

    </nav>
</aside>