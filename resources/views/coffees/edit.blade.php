<x-app-layout>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-[#3e2723] p-8">
                
                <form action="{{ route('coffees.update', $coffee) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold text-[#3e2723] mb-1">Coffee Name</label>
                            <input type="text" name="name" value="{{ old('name', $coffee->name) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#8d6e63]" required>
                        </div>
                        
                        <div>
                            <label class="block font-bold text-[#3e2723] mb-1">Category</label>
                            <input type="text" name="category" value="{{ old('category', $coffee->category) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#8d6e63]" required>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block font-bold text-[#3e2723] mb-1">Price ($)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $coffee->price) }}" class="w-full md:w-1/2 border-gray-300 rounded-lg shadow-sm focus:ring-[#8d6e63]" required>
                    </div>
                    
                    <div>
                        <label class="block font-bold text-[#3e2723] mb-1">Description</label>
                        <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#8d6e63]" required>{{ old('description', $coffee->description) }}</textarea>
                    </div>
                    
                    <div class="bg-[#efebe9] p-4 rounded-lg border border-[#d7ccc8] flex items-center gap-6">
                        @if($coffee->image)
                            <img src="{{ asset('storage/' . $coffee->image) }}" alt="Current Image" class="w-24 h-24 object-cover rounded shadow-md border-2 border-white">
                        @endif
                        <div class="flex-grow">
                            <label class="block font-bold text-[#3e2723] mb-2">Update Image</label>
                            <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#3e2723] file:text-white hover:file:bg-[#2e1d1a] transition">
                            <small class="block mt-2 text-gray-500 font-medium">Leave blank to keep the current image.</small>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-bold hover:bg-gray-50 transition">Cancel</a>
                        <button type="submit" class="bg-[#3e2723] text-white px-6 py-2 rounded-lg shadow-lg hover:bg-[#5d4037] font-bold transition">
                            Update Coffee
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>