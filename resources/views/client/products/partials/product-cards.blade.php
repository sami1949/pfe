@foreach($products as $product)
    <div class="flip-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-[28rem] relative group">
        <div class="flip-card-inner relative w-full h-full">
            <!-- Front of the card -->
            <div class="flip-card-front absolute w-full h-full p-6 backface-hidden flex flex-col">
                @if($product->image)
                <div class="relative overflow-hidden rounded-xl h-56 mb-4 group">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/20 to-transparent"></div>
                </div>
                @endif
                
                <h3 class="text-xl font-bold text-gray-800">{{ $product->name }}</h3>
                <p class="text-gray-600 mt-2 line-clamp-2 flex-grow">{{ $product->description }}</p>
                
                <div class="mt-4 flex justify-between items-center pt-4">
                    <span class="text-2xl font-bold text-teal-600">{{ number_format($product->price, 2) }}€</span>
                    <button onclick="flipCard(this)" 
                    class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-5 py-2 rounded-xl hover:from-teal-600 hover:to-teal-700 transition-all shadow-md hover:shadow-teal-200 flex items-center">
                        Details
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Back of the card -->
            <div class="flip-card-back absolute w-full h-full p-6 backface-hidden bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                <div class="h-full flex flex-col">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $product->name }}</h3>
                    
                    <div class="space-y-3 flex-grow">
                        <div class="flex items-start bg-white p-3 rounded-lg shadow-sm">
                            <div class="bg-teal-100 p-1 rounded-full mr-3">
                                <svg class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Premium Quality</h4>
                                <p class="text-sm text-gray-500 mt-1">Made with finest materials</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start bg-white p-3 rounded-lg shadow-sm">
                            <div class="bg-teal-100 p-1 rounded-full mr-3">
                                <svg class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Comfort Fit</h4>
                                <p class="text-sm text-gray-500 mt-1">Designed for all-day wear</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start bg-white p-3 rounded-lg shadow-sm">
                            <div class="bg-teal-100 p-1 rounded-full mr-3">
                                <svg class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Eco-Friendly</h4>
                                <p class="text-sm text-gray-500 mt-1">Sustainable production</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center pt-4 border-t border-gray-200">
                        <span class="text-2xl font-bold text-teal-600">{{ number_format($product->price, 2) }}€</span>
                        <div class="flex space-x-3">
                            <button onclick="flipCard(this)" 
                                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300 transition-all flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Back
                            </button>
                            
                            @auth
                            <button onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', {{ $product->price }}, '{{ $product->image }}')" 
                                    class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-5 py-2 rounded-xl hover:from-teal-600 hover:to-teal-700 transition-all shadow-md hover:shadow-teal-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>
                                Add to Cart
                            </button>
                            @else
                            <a href="{{ route('login') }}" 
                               class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-5 py-2 rounded-xl hover:from-teal-600 hover:to-teal-700 transition-all shadow-md hover:shadow-teal-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Login to Buy
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach 