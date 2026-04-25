<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Control Panel') }}
            </h2>
            <a href="{{ route('coffees.create') }}" class="bg-[#3e2723] text-white px-4 py-2 rounded-lg shadow hover:bg-[#5d4037] transition font-bold text-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add New Coffee
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-[#3e2723]">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#efebe9] text-[#3e2723] text-sm uppercase tracking-wide border-b-2 border-[#d7ccc8]">
                                <th class="p-4 rounded-tl-lg">Image</th>
                                <th class="p-4">Name</th>
                                <th class="p-4">Category</th>
                                <th class="p-4">Price</th>
                                <th class="p-4 text-center rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($coffees as $coffee)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="p-4">
                                        @if($coffee->image)
                                            <img src="{{ asset('storage/' . $coffee->image) }}" class="w-14 h-14 object-cover rounded-lg shadow-sm border border-gray-200">
                                        @else
                                            <div class="w-14 h-14 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-500 shadow-sm">No Img</div>
                                        @endif
                                    </td>
                                    <td class="p-4 font-bold text-[#3e2723]">{{ $coffee->name }}</td>
                                    <td class="p-4">
                                        <span class="bg-[#d7ccc8] text-[#3e2723] text-xs px-2 py-1 rounded-full font-semibold">{{ $coffee->category }}</span>
                                    </td>
                                    <td class="p-4 font-semibold text-green-700">₱{{ number_format($coffee->price, 2) }}</td>
                                    <td class="p-4 flex justify-center gap-3 items-center h-full mt-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('coffees.edit', $coffee) }}" class="text-blue-600 hover:text-blue-800 font-semibold bg-blue-50 px-3 py-1 rounded transition">Edit</a>
                                        
                                        <!-- Delete Form -->
                                        <form action="{{ route('coffees.destroy', $coffee) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coffee?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold bg-red-50 px-3 py-1 rounded transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500 font-medium">No coffees found on the menu. Time to add some!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $coffees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>