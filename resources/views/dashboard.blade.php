<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <a href="{{ route('cart') }}" class="font-bold underline hover:text-green-900">View Cart</a>
                </div>
            @endif

            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8 border-l-4 border-[#3e2723]">
                <h3 class="text-2xl font-bold text-[#3e2723]">Welcome, {{ auth()->user()->name }}!</h3>
                <p class="text-gray-600 mt-1">Choose your favorite coffee from our menu below to add to your cart.</p>
            </div>

            <!-- Coffee Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($coffees as $coffee)
                    <!-- Alpine.js Component wrapper -->
                    <div x-data="{ showModal: false, quantity: 1 }" class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col relative">
                        
                        @if($coffee->image)
                            <img src="{{ asset('storage/' . $coffee->image) }}" alt="{{ $coffee->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-[#d7ccc8] flex items-center justify-center text-[#5d4037]">No Image</div>
                        @endif
                        
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-semibold text-[#3e2723]">{{ $coffee->name }}</h3>
                                <span class="font-bold text-lg text-[#3e2723]">₱{{ number_format($coffee->price, 2) }}</span>
                            </div>
                            
                            <span class="text-xs bg-[#efebe9] px-2 py-1 rounded text-[#5d4037] inline-block self-start mb-4">
                                {{ $coffee->category }}
                            </span>
                            
                            <p class="text-sm text-gray-600 mb-6 flex-grow">{{ Str::limit($coffee->description, 80) }}</p>
                            
                            <!-- Trigger to open modal -->
                            <button @click="showModal = true" type="button" class="mt-auto w-full bg-[#3e2723] text-white px-4 py-2 rounded shadow hover:bg-[#5d4037] transition duration-150">
                                View & Add to Cart
                            </button>
                        </div>

                        <!-- MODAL (Hidden by default) -->
                        <div x-show="showModal" 
                             style="display: none;" 
                             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm px-4">
                            
                            <!-- Modal Content Box -->
                            <div @click.away="showModal = false" 
                                 class="bg-white rounded-xl shadow-2xl max-w-lg w-full overflow-hidden transform transition-all">
                                
                                <!-- Modal Header / Image -->
                                <div class="relative h-56">
                                    @if($coffee->image)
                                        <img src="{{ asset('storage/' . $coffee->image) }}" alt="{{ $coffee->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-[#d7ccc8] flex items-center justify-center text-[#5d4037]">No Image</div>
                                    @endif
                                    
                                    <!-- Close Button (X) -->
                                    <button @click="showModal = false" class="absolute top-4 right-4 bg-white rounded-full p-1 text-gray-800 hover:text-red-500 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <div class="p-6">
                                    <div class="flex justify-between items-center mb-2">
                                        <h3 class="text-2xl font-bold text-[#3e2723]">{{ $coffee->name }}</h3>
                                        <span class="text-xl font-bold text-[#3e2723]">₱{{ number_format($coffee->price, 2) }}</span>
                                    </div>
                                    <span class="text-xs bg-[#efebe9] px-2 py-1 rounded text-[#5d4037] inline-block mb-4">
                                        {{ $coffee->category }}
                                    </span>
                                    
                                    <p class="text-gray-600 mb-6 leading-relaxed">
                                        {{ $coffee->description }}
                                    </p>

                                    <!-- Add to Cart Form -->
                                    <form action="{{ route('cart.add', $coffee->id) }}" method="POST">
                                        @csrf
                                        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                                            
                                            <!-- Quantity Selector -->
                                            <div class="flex items-center space-x-4 border border-[#d7ccc8] rounded-lg px-2 py-1 bg-gray-50">
                                                <button type="button" @click="quantity > 1 ? quantity-- : null" class="text-gray-500 hover:text-[#3e2723] p-1 font-bold text-xl">
                                                    -
                                                </button>
                                                <!-- Hidden input bound to Alpine quantity to send to Laravel -->
                                                <input type="hidden" name="quantity" x-model="quantity">
                                                <!-- Display quantity -->
                                                <span class="w-6 text-center font-bold text-lg text-[#3e2723]" x-text="quantity"></span>
                                                <button type="button" @click="quantity++" class="text-gray-500 hover:text-[#3e2723] p-1 font-bold text-xl">
                                                    +
                                                </button>
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit" class="bg-[#3e2723] text-white px-6 py-3 rounded-lg shadow-md hover:bg-[#5d4037] transition duration-150 font-bold flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Add to Cart
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $coffees->links() }}
            </div>
            
        </div>
    </div>
</x-app-layout>