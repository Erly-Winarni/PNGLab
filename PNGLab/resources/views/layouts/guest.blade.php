<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-Poppins text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-black p-4">

            <div class="w-full sm:max-w-md bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{-- Kelas `mt-6 px-6 py-4` dihapus dari div ini, atau Anda bisa menyesuaikannya --}}
                {{ $slot }}
            </div>
        </div>
        
    </body>
</html>