<nav x-data="{ open: false }" class="bg-[#3e2723] border-b border-[#5d4037]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-2xl font-bold text-[#d7ccc8]">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coffee">
                <path d="M10 2v2"/>
                <path d="M14 2v2"/>
                <path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"/>
                <path d="M6 2v2"/>
            </svg>
            Lumina Cafe
            </a>

                <!-- Navigation Links (Desktop) -->
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                <!-- Point Menu directly to the dashboard -->
                    <a href="{{ route('dashboard') }}" class="text-[#e0e0e0] hover:text-white transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'font-bold text-white border-b-2 border-white pb-1' : '' }}">
                        Menu
                    </a>
                    <a href="{{ route('cart') }}" class="text-[#e0e0e0] hover:text-white transition duration-150 ease-in-out {{ request()->routeIs('cart') ? 'font-bold text-white border-b-2 border-white pb-1' : '' }}">
                        Cart
                    </a>
                    <a href="{{ route('about') }}" class="text-[#e0e0e0] hover:text-white transition duration-150 ease-in-out {{ request()->routeIs('about') ? 'font-bold text-white border-b-2 border-white pb-1' : '' }}">
                        About Us
                    </a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-[#e0e0e0] hover:text-white transition duration-150 ease-in-out font-bold ml-4">
                        Admin Panel
                    </a>
                @endif
        </div>
    </div>

            <!-- Settings Dropdown / Logout (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[#e0e0e0] hover:text-white transition duration-150 ease-in-out">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#bcaaa4] hover:text-white hover:bg-[#5d4037] focus:outline-none focus:bg-[#5d4037] focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#5d4037]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                {{ __('Menu') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart')" :active="request()->routeIs('cart')" class="text-white">
                {{ __('Cart') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white">
                {{ __('About Us') }}
            </x-responsive-nav-link>
            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white">
                    {{ __('Admin Panel') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[#3e2723]">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#bcaaa4]">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-white">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
