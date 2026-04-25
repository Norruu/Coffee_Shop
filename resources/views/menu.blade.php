<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu - Lumina Coffee Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fdfbf7] text-[#4a3b32] font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-[#3e2723] p-4 text-[#e0e0e0] flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-[#d7ccc8]">☕ Lumina Coffee</a>
        <div class="space-x-4">
            <a href="{{ route('menu') }}" class="hover:text-white">Menu</a>
            <a href="{{ route('about') }}" class="hover:text-white">About Us</a>
            @auth
                <a href="{{ url('/dashboard') }}" class="hover:text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-white">Log in</a>
                <a href="{{ route('register') }}" class="hover:text-white">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Menu Content -->
    <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 text-[#3e2723]">Our Full Menu</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($coffees as $coffee)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($coffee->image)
                        <img src="{{ asset('storage/' . $coffee->image) }}" alt="{{ $coffee->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-[#d7ccc8] flex items-center justify-center text-[#5d4037]">No Image</div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $coffee->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $coffee->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-[#3e2723]">${{ number_format($coffee->price, 2) }}</span>
                            <span class="text-xs bg-[#efebe9] px-2 py-1 rounded text-[#5d4037]">{{ $coffee->category }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-10">
            {{ $coffees->links() }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#3e2723] text-center p-6 text-[#bcaaa4] mt-12">
        <p>&copy; {{ date('Y') }} Lumina Coffee Shop. All rights reserved.</p>
    </footer>
</body>
</html>
