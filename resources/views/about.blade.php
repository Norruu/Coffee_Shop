<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Hero Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-10 text-center bg-[#3e2723] text-[#efebe9]">
                    <h1 class="text-4xl font-extrabold mb-4">Crafting the Perfect Cup</h1>
                    <p class="text-lg max-w-2xl mx-auto text-[#d7ccc8]">
                        At Lumina Cafe, we believe that coffee is more than just a drink—it's an experience. 
                        Every bean is ethically sourced, and every cup is brewed with passion.
                    </p>
                </div>
            </div>

            <!-- Meet the Team Grid -->
            <h2 class="text-3xl font-bold text-center text-[#3e2723] mb-8">Meet Our Team</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Team Member 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col items-center p-8 border-t-4 border-[#3e2723] hover:shadow-lg transition-shadow">
                    <!-- Replace 'dev1.jpg' with your actual image file name -->
                    <img src="{{ asset('images/team/Krish.jpg') }}" alt="Krishelle Sobrevillia" class="w-24 h-24 rounded-full object-cover shadow-md mb-4 border-4 border-[#efebe9]">
                    
                    <h3 class="text-xl font-bold text-[#3e2723]">Krishelle Sobrevillia</h3>
                    <p class="text-sm font-bold text-[#8d6e63] mb-3 uppercase tracking-wide">Lead Developer</p>
                    <p class="text-center text-gray-600 text-sm">Architecting the digital experience and ensuring everything runs smoothly behind the scenes.</p>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col items-center p-8 border-t-4 border-[#5d4037] hover:shadow-lg transition-shadow">
                    <!-- Replace 'dev2.jpg' with your actual image file name -->
                    <img src="{{ asset('images/team/Shan.jpg') }}" alt="Shantal Mae Lee" class="w-24 h-24 rounded-full object-cover shadow-md mb-4 border-4 border-[#efebe9]">
                    
                    <h3 class="text-xl font-bold text-[#3e2723]">Shantal Mae Lee</h3>
                    <p class="text-sm font-bold text-[#8d6e63] mb-3 uppercase tracking-wide">UI/UX Designer</p>
                    <p class="text-center text-gray-600 text-sm">Crafting warm, intuitive, and beautiful interfaces that make ordering your favorite coffee a breeze.</p>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col items-center p-8 border-t-4 border-[#8d6e63] hover:shadow-lg transition-shadow">
                    <!-- Replace 'dev3.jpg' with your actual image file name -->
                    <img src="{{ asset('images/team/Yvon.jpg') }}" alt="Yvonne Grace Ochida" class="w-24 h-24 rounded-full object-cover shadow-md mb-4 border-4 border-[#efebe9]">
                    
                    <h3 class="text-xl font-bold text-[#3e2723]">Yvonne Grace Ochida</h3>
                    <p class="text-sm font-bold text-[#8d6e63] mb-3 uppercase tracking-wide">Database Admin</p>
                    <p class="text-center text-gray-600 text-sm">Keeping our data secure, organized, and lightning-fast so we never miss a single coffee order.</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>