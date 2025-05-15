<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4">
            <h2 class="font-bold text-2xl md:text-3xl text-gray-800">
                {{ __('Nos Produits') }} 
                @if($category)
                    <span class="text-teal-600">- {{ ucfirst($category) }}</span>
                @endif
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Category Navigation -->
            <div class="mb-12">
                <!-- Mobile Category Navigation -->
                <div class="lg:hidden">
                    <div class="relative">
                        <select onchange="window.location.href=this.value" class="w-full appearance-none bg-white/80 backdrop-blur-xl px-4 py-3 rounded-2xl border border-white/20 text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent pr-12 shadow-lg">
                            <option value="{{ auth()->check() ? route('product.private') : route('product.public') }}" {{ !$category ? 'selected' : '' }}>Tous les produits</option>
                            <option value="{{ auth()->check() ? route('product.private', ['category' => 'nouveau']) : route('product.public', ['category' => 'nouveau']) }}" {{ $category === 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                            <option value="{{ auth()->check() ? route('product.private', ['category' => 'maquillage']) : route('product.public', ['category' => 'maquillage']) }}" {{ $category === 'maquillage' ? 'selected' : '' }}>Se maquiller</option>
                            <option value="{{ auth()->check() ? route('product.private', ['category' => 'skincare']) : route('product.public', ['category' => 'skincare']) }}" {{ $category === 'skincare' ? 'selected' : '' }}>Skin Care</option>
                            <option value="{{ auth()->check() ? route('product.private', ['category' => 'corps']) : route('product.public', ['category' => 'corps']) }}" {{ $category === 'corps' ? 'selected' : '' }}>Soin du corps</option>
                            <option value="{{ auth()->check() ? route('product.private', ['category' => 'cheveux']) : route('product.public', ['category' => 'cheveux']) }}" {{ $category === 'cheveux' ? 'selected' : '' }}>Soin des cheveux</option>
                            <option value="{{ auth()->check() ? route('product.private', ['category' => 'fragrance']) : route('product.public', ['category' => 'fragrance']) }}" {{ $category === 'fragrance' ? 'selected' : '' }}>Fragrance</option>
                            <option value="{{ auth()->check() ? route('product.private', ['category' => 'vente']) : route('product.public', ['category' => 'vente']) }}" {{ $category === 'vente' ? 'selected' : '' }}>VENTE</option>
                            <option value="{{ auth()->check() ? route('product.private', ['category' => 'brands']) : route('product.public', ['category' => 'brands']) }}" {{ $category === 'brands' ? 'selected' : '' }}>Brands</option>
                        </select>
                    </div>
                </div>

                <!-- Desktop Category Navigation -->
                <div class="hidden lg:block">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @auth
                        <!-- Main Categories -->
                    <a href="{{ route('product.private') }}" 
                            class="modern-card group {{ !$category ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">Tous les produits</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Découvrez notre collection complète</p>
                            </div>
                        </a>

                        <a href="{{ route('product.private', ['category' => 'nouveau']) }}" 
                            class="modern-card group {{ $category === 'nouveau' ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="new-badge">NEW</div>
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">Nouveautés</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Les dernières tendances beauté</p>
                            </div>
                        </a>

                        <a href="{{ route('product.private', ['category' => 'maquillage']) }}" 
                            class="modern-card group {{ $category === 'maquillage' ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">Se maquiller</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Produits de maquillage premium</p>
                            </div>
                        </a>

                        <a href="{{ route('product.private', ['category' => 'skincare']) }}" 
                            class="modern-card group {{ $category === 'skincare' ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">Skin Care</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Prenez soin de votre peau</p>
                            </div>
                        </a>

                        <a href="{{ route('product.private', ['category' => 'corps']) }}" 
                            class="modern-card group {{ $category === 'corps' ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">Soin du corps</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Une peau douce et hydratée</p>
                            </div>
                        </a>

                        <a href="{{ route('product.private', ['category' => 'cheveux']) }}" 
                            class="modern-card group {{ $category === 'cheveux' ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">Soin des cheveux</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Des cheveux brillants et sains</p>
                            </div>
                        </a>

                        <a href="{{ route('product.private', ['category' => 'fragrance']) }}" 
                            class="modern-card group {{ $category === 'fragrance' ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">Fragrance</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Des parfums envoûtants</p>
                            </div>
                        </a>

                        <a href="{{ route('product.private', ['category' => 'vente']) }}" 
                            class="modern-card sale-card group {{ $category === 'vente' ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="sale-badge">-20%</div>
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">VENTE</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Offres exceptionnelles</p>
                            </div>
                        </a>

                        <a href="{{ route('product.private', ['category' => 'brands']) }}" 
                            class="modern-card group {{ $category === 'brands' ? 'active' : '' }}">
                            <div class="card-blur"></div>
                            <div class="card-content">
                                <div class="card-icon-wrapper">
                                    <svg class="card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="card-title">Brands</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Marques de luxe</p>
                            </div>
                        </a>
                        @else
                        <!-- Repeat the same structure for non-authenticated users but with public routes -->
                    @endauth
                    </div>
                </div>
            </div>

            <!-- Products grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="products-container">
                @foreach($randomProducts as $product)
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
                                        <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ asset('storage/' . $product->image) }}')" 
                                            class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-5 py-2 rounded-xl hover:from-teal-600 hover:to-teal-700 transition-all shadow-md hover:shadow-teal-200 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Remaining products (hidden by default) -->
                @foreach($remainingProducts as $product)
                <div class="flip-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-[28rem] relative group hidden more-products">
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
                                
                                <!-- Product description -->
                                <div class="mb-4 p-3 bg-white rounded-lg shadow-sm">
                                    <h4 class="font-medium text-gray-800">Description</h4>
                                    <p class="text-gray-600 mt-1">{{ $product->description }}</p>
                                </div>
                                
                                <!-- Features section -->
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
                                        <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ asset('storage/' . $product->image) }}')" 
                                                class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-5 py-2 rounded-xl hover:from-teal-600 hover:to-teal-700 transition-all shadow-md hover:shadow-teal-200 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                            </svg>
                                            Add to Cart
                                        </button>
                                        @else
                                        <a href="{{ route('login') }}" 
                                            class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-5 py-2 rounded-xl hover:from-teal-600 hover:to-teal-700 transition-all shadow-md hover:shadow-teal-200 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                            </svg>
                                            Add to Cart
                                        </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Show More button -->
            @if($remainingProducts->count() > 0)
            <div class="mt-12 text-center">
                <button onclick="showMoreProducts()" 
                        class="bg-white border-2 border-teal-600 text-teal-600 hover:bg-teal-600 hover:text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
                    Afficher plus de produits ({{ $remainingProducts->count() }})
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            @endif
        </div>
    </div>

    <style>
        .flip-card {
            perspective: 1200px;
        }
        
        .flip-card-inner {
            transition: transform 0.7s cubic-bezier(0.4, 0.2, 0.2, 1);
            transform-style: preserve-3d;
            position: relative;
            height: 100%;
            width: 100%;
        }
        
        .flip-card.flipped .flip-card-inner {
            transform: rotateY(180deg);
        }
        
        .backface-hidden {
            backface-visibility: hidden;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .flip-card-front {
            z-index: 2;
            transform: rotateY(0deg);
        }
        
        .flip-card-back {
            transform: rotateY(180deg);
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .flip-card {
            box-shadow: 0 8px 25px -8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .flip-card:hover {
            transform: translateY(-5px);
        }

        .modern-card {
            @apply relative overflow-hidden rounded-2xl transition-all duration-500 
                   bg-gradient-to-br from-white/80 to-white/40 backdrop-blur-lg
                   border border-white/20 shadow-[0_8px_20px_rgba(0,0,0,0.06)]
                   hover:shadow-[0_15px_30px_rgba(0,0,0,0.1)] hover:-translate-y-1;
        }

        .card-blur {
            @apply absolute inset-0 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl opacity-0
                   group-hover:opacity-100 transition-opacity duration-300;
        }

        .card-content {
            @apply relative p-6 flex flex-col items-center text-center z-10;
        }

        .card-icon-wrapper {
            @apply mb-4 p-4 rounded-2xl bg-gradient-to-br from-teal-500/10 to-teal-500/5
                   text-teal-600 transition-all duration-500 transform
                   group-hover:scale-110 group-hover:rotate-3 group-hover:bg-teal-500/20;
        }

        .card-icon {
            @apply w-8 h-8 transition-transform duration-500 group-hover:scale-110;
        }

        .card-title {
            @apply text-lg font-semibold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent
                   transition-all duration-300 group-hover:from-teal-600 group-hover:to-teal-800;
        }

        .card-line {
            @apply w-12 h-0.5 my-3 bg-gradient-to-r from-teal-500 to-teal-600 rounded-full
                   transition-all duration-300 group-hover:w-24 group-hover:from-teal-400 group-hover:to-teal-600;
        }

        .card-description {
            @apply text-sm text-gray-600/90 transition-colors duration-300 
                   group-hover:text-gray-700;
        }

        .modern-card.active {
            @apply bg-gradient-to-br from-teal-500 to-teal-600 border-teal-400/20
                   shadow-[0_8px_20px_rgba(13,148,136,0.2)];
        }

        .modern-card.active .card-icon-wrapper {
            @apply bg-white/20 text-white;
        }

        .modern-card.active .card-title {
            @apply from-white to-white/90;
        }

        .modern-card.active .card-line {
            @apply from-white to-white/80;
        }

        .modern-card.active .card-description {
            @apply text-white/90;
        }

        .new-badge {
            @apply absolute top-4 right-4 px-2.5 py-1 bg-gradient-to-r from-teal-400 to-teal-500
                   text-white text-xs font-bold rounded-full shadow-lg
                   animate-pulse;
        }

        .sale-card {
            @apply bg-gradient-to-br from-rose-500/10 to-red-500/5;
        }

        .sale-card .card-icon-wrapper {
            @apply from-rose-500/10 to-red-500/5 text-rose-500;
        }

        .sale-card:hover .card-title {
            @apply from-rose-600 to-red-700;
        }

        .sale-card .card-line {
            @apply from-rose-500 to-red-500;
        }

        .sale-badge {
            @apply absolute top-4 right-4 px-3 py-1 bg-gradient-to-r from-rose-500 to-red-500
                   text-white text-sm font-bold rounded-full shadow-lg
                   animate-bounce;
        }

        .sale-card.active {
            @apply from-rose-500 to-red-600 border-rose-400/20
                   shadow-[0_8px_20px_rgba(225,29,72,0.2)];
        }

        .sale-card.active .card-icon-wrapper {
            @apply bg-white/20 text-white;
        }

        /* Hover Animation */
        .modern-card::after {
            content: '';
            @apply absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent
                   -translate-x-full;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modern-card:hover::after {
            @apply translate-x-full;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        .modern-card:hover {
            animation: float 3s ease-in-out infinite;
        }
        /* Category Navigation Styles */
.modern-card {
    position: relative;
    overflow: hidden;
    border-radius: 1.5rem;
    padding: 2rem;
    height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    cursor: pointer;
    color: #2d3748;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
    z-index: 1;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.2);
}

.modern-card.active {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.5);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
}

.card-blur {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 100%);
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.modern-card:hover .card-blur {
    opacity: 1;
}

.card-content {
    position: relative;
    z-index: 2;
}

.card-icon-wrapper {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.modern-card:hover .card-icon-wrapper {
    transform: scale(1.1);
    background: rgba(255, 255, 255, 0.95);
}

.card-icon {
    width: 28px;
    height: 28px;
    stroke-width: 1.5;
    color: #4a5568;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #2d3748;
    letter-spacing: -0.5px;
    transition: all 0.3s ease;
}

.modern-card:hover .card-title {
    color: #1a365d;
}

.card-line {
    width: 40px;
    height: 2px;
    background: linear-gradient(90deg, rgba(74, 85, 104, 0.2) 0%, rgba(74, 85, 104, 0.5) 50%, rgba(74, 85, 104, 0.2) 100%);
    margin: 0 auto 0.75rem;
    transition: all 0.3s ease;
}

.modern-card:hover .card-line {
    width: 60px;
    background: linear-gradient(90deg, rgba(45, 55, 72, 0.3) 0%, rgba(45, 55, 72, 0.6) 50%, rgba(45, 55, 72, 0.3) 100%);
}

.card-description {
    font-size: 0.875rem;
    color: #4a5568;
    opacity: 0.9;
    transition: all 0.3s ease;
}

.modern-card:hover .card-description {
    opacity: 1;
    color: #2d3748;
}

/* Special badges */
.new-badge, .sale-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.new-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.sale-badge {
    background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
    color: white;
}

/* Special card styles */
.sale-card {
    background: rgba(254, 226, 226, 0.6);
    border: 1px solid rgba(254, 226, 226, 0.4);
}

.sale-card:hover {
    background: rgba(254, 226, 226, 0.8);
}

.sale-card .card-icon {
    color: #e53e3e;
}

.sale-card .card-title {
    color: #9b2c2c;
}

.sale-card:hover .card-title {
    color: #742a2a;
}

/* Mobile select styles */
.relative select {
    transition: all 0.3s ease;
}

.relative select:focus {
    box-shadow: 0 0 0 3px rgba(49, 151, 149, 0.2);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .modern-card {
        height: 180px;
        padding: 1.5rem;
    }
    
    .card-icon-wrapper {
        width: 50px;
        height: 50px;
    }
    
    .card-icon {
        width: 24px;
        height: 24px;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
    
    .card-description {
        font-size: 0.8rem;
    }
}
    </style>

    <script>
        function showMoreProducts() {
            // Show all hidden products with animation
            const hiddenProducts = document.querySelectorAll('.more-products');
            hiddenProducts.forEach((product, index) => {
                setTimeout(() => {
                    product.classList.remove('hidden');
                    product.classList.add('animate-fadeIn');
                }, index * 100);
            });
            
            // Hide the show more button with fade out
            const button = event.target;
            button.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                button.style.display = 'none';
            }, 300);
        }
        
        function flipCard(button) {
            const card = button.closest('.flip-card');
            card.classList.toggle('flipped');
            
            // Reset other cards if needed
            document.querySelectorAll('.flip-card').forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('flipped');
                }
            });
        }

        // Add fadeIn animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fadeIn {
                animation: fadeIn 0.5s ease-out forwards;
            }
        `;
        document.head.appendChild(style);

        // Cart functionality
        document.addEventListener('DOMContentLoaded', function() {
            initializeCart();
            updateCartCount();
        });

        function initializeCart() {
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            
            // Initialize empty cart if it doesn't exist
            if (!localStorage.getItem(cartKey)) {
                localStorage.setItem(cartKey, JSON.stringify({}));
            }
        }

        function addToCart(productId, productName, productPrice, productImage = null) {
            // Check if user is authenticated
            @if(!auth()->check())
                window.location.href = "{{ route('login') }}";
                return;
            @endif

            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            let cart = JSON.parse(localStorage.getItem(cartKey)) || {};
            
            // Check if product already exists in cart
            if (cart[productId]) {
                cart[productId].quantity += 1;
            } else {
                cart[productId] = {
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1
                };
            }
            
            localStorage.setItem(cartKey, JSON.stringify(cart));
            updateCartCount();
            showNotification(`${productName} added to cart!`);
        }

        function updateCartCount() {
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            let cart = JSON.parse(localStorage.getItem(cartKey)) || {};
            let totalItems = 0;
            
            // Calculate total quantity
            for (let productId in cart) {
                totalItems += cart[productId].quantity;
            }
            
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = totalItems;
            }
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-teal-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-10 opacity-0 transition-all duration-300';
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-y-10', 'opacity-0');
                notification.classList.add('translate-y-0', 'opacity-100');
            }, 10);
            
            // Animate out after 3 seconds
            setTimeout(() => {
                notification.classList.remove('translate-y-0', 'opacity-100');
                notification.classList.add('translate-y-10', 'opacity-0');
                
                // Remove after animation
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
    </script>
</x-app-layout>