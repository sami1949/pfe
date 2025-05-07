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
            <!-- Category filter links -->
            <div class="mb-10">
                <div class="flex flex-wrap gap-3 md:gap-6 items-center">
                    @auth
                    <a href="{{ route('product.private') }}" 
                       class="px-4 py-2 rounded-full transition-all {{ !$category ? 'bg-teal-600 text-white font-medium shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                       Tous les produits
                    </a>
                    <a href="{{ route('product.private', ['category' => 'homme']) }}" 
                        class="px-4 py-2 rounded-full transition-all {{ $category === 'homme' ? 'bg-teal-600 text-white font-medium shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Homme
                    </a>
                    <a href="{{ route('product.private', ['category' => 'femme']) }}" 
                        class="px-4 py-2 rounded-full transition-all {{ $category === 'femme' ? 'bg-teal-600 text-white font-medium shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Femme
                    </a>
                    @else
                    <a href="{{ route('product.public') }}" 
                        class="px-4 py-2 rounded-full transition-all {{ !$category ? 'bg-teal-600 text-white font-medium shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Tous les produits
                    </a>
                    <a href="{{ route('product.public', ['category' => 'homme']) }}" 
                        class="px-4 py-2 rounded-full transition-all {{ $category === 'homme' ? 'bg-teal-600 text-white font-medium shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Homme
                    </a>
                    <a href="{{ route('product.public', ['category' => 'femme']) }}" 
                        class="px-4 py-2 rounded-full transition-all {{ $category === 'femme' ? 'bg-teal-600 text-white font-medium shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Femme
                    </a>
                    @endauth
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
                                        <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})" 
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
        
        <!-- Back of the card (this was missing proper content) -->
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
            updateCartCount();
        });

        function addToCart(productId, productName, productPrice) {
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
                    quantity: 1
                };
            }
            
            localStorage.setItem(cartKey, JSON.stringify(cart));
            updateCartCount();
            
            // Show notification
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
    </script>
</x-app-layout>