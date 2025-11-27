<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-Poppins text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-[#20232a] p-4">

            <div class="w-full bg-white shadow-md overflow-hidden">
                {{-- Kelas `mt-6 px-6 py-4` dihapus dari div ini, atau Anda bisa menyesuaikannya --}}
                {{ $slot }}
            </div>
        </div>
        
    </body>
</html>