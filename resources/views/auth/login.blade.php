<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Lumina Cafe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#efebe9] min-h-screen flex items-center justify-center p-4 sm:p-8 font-sans antialiased">

    <!-- Main Container -->
    <div class="bg-white w-full max-w-5xl rounded-2xl shadow-2xl flex overflow-hidden min-h-[650px]">
        
        <!-- Left Side: Form Area -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center relative">
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Logo -->
            <div class="flex items-center gap-2 mb-8 justify-center md:justify-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#3e2723]">
                    <path d="M10 2v2"/><path d="M14 2v2"/><path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"/><path d="M6 2v2"/>
                </svg>
                <span class="text-2xl font-bold text-[#3e2723]">Lumina Cafe</span>
            </div>

            <!-- Title -->
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center md:text-left">Sign Into Your Account</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Mail Icon -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Email Address" 
                               class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-[#8d6e63] focus:ring focus:ring-[#8d6e63] focus:ring-opacity-50 py-3">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <div class="relative" x-data="{ show: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Lock Icon -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" placeholder="Password"
                               class="pl-10 pr-10 w-full border-gray-300 rounded-lg shadow-sm focus:border-[#8d6e63] focus:ring focus:ring-[#8d6e63] focus:ring-opacity-50 py-3">
                        
                        <!-- Toggle Password Visibility Icon -->
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" @click="show = !show">
                            <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#3e2723] shadow-sm focus:ring-[#8d6e63]" name="remember">
                        <span class="ms-2 text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-[#8d6e63] hover:text-[#3e2723] font-semibold hover:underline" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-[#3e2723] hover:bg-[#2e1d1a] text-white font-bold py-3 rounded-lg shadow-lg transition duration-150">
                    Login
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-8 text-center text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-[#8d6e63] hover:text-[#3e2723] font-bold hover:underline">
                    Register here
                </a>
            </div>

        </div>

        <!-- Right Side: Image/Illustration area -->
        <!-- We use a high-quality coffee image to match the cafe theme -->
        <div class="hidden md:block w-1/2 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
            <!-- Overlay to darken the image slightly -->
            <div class="absolute inset-0 bg-[#3e2723] bg-opacity-30"></div>
            
            <!-- Optional Text inside image -->
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-8 text-center">
                <h3 class="text-4xl font-extrabold mb-4 drop-shadow-md">Your Daily Brew</h3>
                <p class="text-lg font-medium drop-shadow-md">Log in to order your favorite coffee and enjoy exclusive rewards.</p>
            </div>
        </div>

    </div>

</body>
</html>