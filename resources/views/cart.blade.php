<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(count($cart) > 0)
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b-2 border-[#5d4037] text-[#3e2723]">
                                    <th class="p-3">Product</th>
                                    <th class="p-3">Price</th>
                                    <th class="p-3 text-center">Quantity</th>
                                    <th class="p-3 text-center">Subtotal</th>
                                    <th class="p-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $details)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3 flex items-center gap-4">
                                            @if($details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" class="w-16 h-16 object-cover rounded shadow">
                                            @else
                                                <div class="w-16 h-16 bg-[#d7ccc8] flex items-center justify-center text-xs text-[#5d4037] rounded">No Img</div>
                                            @endif
                                            <span class="font-bold text-[#3e2723]">{{ $details['name'] }}</span>
                                        </td>
                                        <td class="p-3">₱{{ number_format($details['price'], 2) }}</td>
                                        
                                        <!-- Update Quantity Form -->
                                        <td class="p-3 text-center">
                                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center justify-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 border-gray-300 rounded text-center h-8">
                                                <button type="submit" class="bg-[#8d6e63] text-white px-2 py-1 rounded text-xs hover:bg-[#5d4037]">Update</button>
                                            </form>
                                        </td>
                                        
                                        <td class="p-3 text-center font-bold text-[#3e2723]">
                                            ₱{{ number_format($details['price'] * $details['quantity'], 2) }}
                                        </td>
                                        
                                        <!-- Delete Form -->
                                        <td class="p-3 text-center">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 hover:underline text-sm font-bold">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Order Summary -->
                        <div class="mt-8 flex justify-end">
                            <div class="bg-[#efebe9] p-6 rounded-lg w-full md:w-1/3 shadow-md">
                                <h3 class="text-xl font-bold text-[#3e2723] mb-4 border-b border-[#d7ccc8] pb-2">Order Summary</h3>
                                <div class="flex justify-between font-bold text-xl text-[#3e2723]">
                                    <span>Total:</span>
                                    <span>₱{{ number_format($total, 2) }}</span>
                                </div>
                                
                                <!-- Updated Checkout Form -->
                                <form action="{{ route('cart.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-[#3e2723] text-white mt-6 py-3 rounded shadow hover:bg-[#2e1d1a] transition duration-150 font-bold">
                                        Proceed to Checkout
                                    </button>
                                </form>
                            </div>
                        </div>

                    @else
                        <!-- Empty Cart State -->
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-[#d7ccc8] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="text-2xl font-bold mb-2 text-[#3e2723]">Your Cart is Empty</h3>
                            <p class="mb-6 text-gray-500">Looks like you haven't added any delicious coffee yet.</p>
                            <a href="{{ route('dashboard') }}" class="bg-[#3e2723] text-white px-6 py-3 rounded shadow hover:bg-[#5d4037] transition duration-150">
                                Browse Menu
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Successful Checkout Modal -->
    @if(session('checkout_success'))
        <div x-data="{ show: true }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm px-4">
            <div @click.away="show = false" class="bg-white rounded-xl shadow-2xl max-w-sm w-full p-8 text-center transform transition-all">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-green-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-[#3e2723] mb-2">Success!</h2>
                <p class="text-gray-600 mb-8">Your order has been placed. Our baristas are preparing your delicious coffee right now!</p>
                <a href="{{ route('dashboard') }}" class="block w-full bg-[#3e2723] text-white py-3 rounded-lg shadow-md hover:bg-[#5d4037] transition duration-150 font-bold">
                    Back to Menu
                </a>
            </div>
        </div>
    @endif
</x-app-layout>