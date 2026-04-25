<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumina Cafe - Premium Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fdfbf7] text-[#4a3b32] font-sans antialiased flex flex-col min-h-screen">

    <!-- Transparent/Dark Navigation -->
    <nav class="absolute top-0 left-0 w-full z-50 bg-black bg-opacity-40 p-4 text-[#e0e0e0] flex justify-between items-center border-b border-white border-opacity-20 backdrop-blur-sm">
        <a href="/" class="flex items-center gap-2 text-2xl font-bold text-white tracking-wide">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10 2v2"/><path d="M14 2v2"/><path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"/><path d="M6 2v2"/>
            </svg>
            Lumina Cafe
        </a>
        <div class="space-x-6 font-medium">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-white hover:text-[#d7ccc8] transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-white hover:text-[#d7ccc8] transition">Log in</a>
                <a href="{{ route('register') }}" class="bg-white text-[#3e2723] px-4 py-2 rounded-full shadow hover:bg-[#efebe9] transition">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Stunning Hero Section with Background Image -->
    <header class="relative bg-cover bg-center h-[70vh] flex items-center justify-center text-center"
            style="background-image: url('https://images.unsplash.com/photo-1442512595331-e89e73853f31?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');">

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Hero Content -->
        <div class="relative z-10 text-white px-4">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-4 drop-shadow-lg tracking-tight">Experience the Perfect Brew</h1>
            <p class="text-xl md:text-2xl mb-8 drop-shadow-md text-gray-200">Crafted with passion, served with love.</p>
            <a href="{{ auth()->check() ? route('dashboard') : route('register') }}"
               class="bg-[#3e2723] px-8 py-4 text-lg font-bold rounded-full shadow-lg hover:bg-[#2e1d1a] transition transform hover:scale-105">
               Explore Our Menu
            </a>
        </div>
    </header>

    <!-- Main Content: Featured Brews -->
    <main class="flex-grow max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 w-full">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-[#3e2723]">Featured Brews</h2>
            <p class="text-gray-500 mt-2">A handpicked selection of our customer favorites.</p>
            <div class="w-24 h-1 bg-[#8d6e63] mx-auto mt-4 rounded"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($coffees as $coffee)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition hover:-translate-y-2 hover:shadow-2xl">
                    @if($coffee->image)
                        <img src="{{ asset('storage/' . $coffee->image) }}" alt="{{ $coffee->name }}" class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-[#d7ccc8] flex items-center justify-center text-[#5d4037] font-medium">No Image Available</div>
                    @endif
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-2xl font-bold text-[#3e2723]">{{ $coffee->name }}</h3>
                            <span class="font-extrabold text-[#8d6e63] text-xl">₱{{ number_format($coffee->price, 2) }}</span>
                        </div>
                        <span class="text-xs font-bold tracking-wider bg-[#efebe9] px-3 py-1 rounded-full text-[#5d4037] uppercase mb-4 inline-block">
                            {{ $coffee->category }}
                        </span>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $coffee->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="text-[#8d6e63] hover:text-[#3e2723] font-bold text-lg border-b-2 border-[#8d6e63] hover:border-[#3e2723] pb-1 transition">
                View Full Menu &rarr;
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#3e2723] text-center p-8 text-[#bcaaa4] mt-auto">
        <div class="flex justify-center items-center gap-2 mb-4 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10 2v2"/><path d="M14 2v2"/><path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"/><path d="M6 2v2"/>
            </svg>
            <span class="text-xl font-bold tracking-wide">Lumina Cafe</span>
        </div>
        <p>&copy; {{ date('Y') }} Lumina Cafe. All rights reserved.</p>
    </footer>
</body>
</html>
