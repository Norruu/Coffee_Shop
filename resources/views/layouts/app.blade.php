<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Lumina Coffee') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <!-- Add flex, flex-col, and min-h-screen here -->
    <body class="font-sans antialiased flex flex-col min-h-screen bg-[#fdfbf7]">

        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content: Add flex-grow so it pushes the footer down -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Sticky Footer using mt-auto -->
        <footer class="bg-[#3e2723] text-center p-6 text-[#bcaaa4] mt-auto">
            <p>&copy; {{ date('Y') }} Lumina Coffee Shop. All rights reserved.</p>
        </footer>
    </body>
</html>
