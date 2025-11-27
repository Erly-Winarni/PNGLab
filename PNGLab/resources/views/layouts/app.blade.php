<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
        <body class="font-Poppins antialiased">
    
            {{-- Container Utama (Tidak perlu Alpine x-data lagi) --}}
            <div class="flex min-h-screen bg-[#212123]"> 
                
                {{-- 1. Sidebar (Hanya tampil di Desktop/md:flex) --}}
                {{-- Kita akan menggunakan flex-col agar menempati ruang di kiri --}}
                <div class="hidden md:flex flex-shrink-0">
                    @include('layouts.navigation-desktop') 
                </div>

                {{-- Page Content Wrapper (Konten & Bottom Nav) --}}
                <div class="flex flex-col flex-1 overflow-y-auto"> 

                    {{-- 1. Top Bar/Header (Tetap sama, hapus tombol hamburger) --}}
                    <header class="h-16 flex items-center justify-between px-4 bg-[#20232a] border-b border-gray-800 shadow-lg">
                        
                        {{-- HAPUS DIV TOMBOL HAMBURGER DI SINI --}}
                        
                        <h1 class="text-xl font-semibold text-white">
                            @isset($header)
                                {{ $header }}
                            @else
                                Dashboard
                            @endisset
                        </h1> 

                        {{-- User Info/Settings --}}
                        <div>
                            <p class="text-sm text-gray-400 hidden sm:block">Selamat Datang, <strong>{{ Auth::user()->name ?? 'Guest' }}</strong> </p>
                        </div>
                    </header>
                    
                    {{-- 2. Konten Utama --}}
                    <main class="p-6 flex-1">
                        {{ $slot }}
                    </main>

                </div>
                
                {{-- 3. Bottom Nav (Hanya tampil di Mobile/sm:fixed) --}}
                <div class="md:hidden">
                    @include('layouts.navigation-bottom') 
                </div>

            </div>
        </body>
</html>
