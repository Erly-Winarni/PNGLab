<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('Laravel', 'PNGLab') }}</title>
        <link rel="icon" href="{{ asset('images/Logo-PNGLab.png') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
        <body class="font-Poppins antialiased bg-[#EAF1FF]">
            <div class="flex min-h-screen"> 
            
                <div class="flex flex-col flex-1 overflow-y-auto"> 
                    
                    <main class="flex-1">
                        {{ $slot }}
                    </main>

                </div>
                
                <div class="md:hidden">
                    {{-- @include('components.navigation-bottom')  --}}
                </div>
            </div>
        </body>
</html>
