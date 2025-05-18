@php
    use App\Models\Product;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4">
            <h2 class="font-bold text-2xl md:text-3xl text-gray-800">
                {{ __('Nos Produits') }} 
                @if($currentGender)
                    <span class="text-teal-600">- {{ ucfirst($currentGender) }}</span>
                @endif
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Gender Navigation -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ auth()->check() ? route('product.private', ['gender' => 'femme']) : route('product.public', ['gender' => 'femme']) }}" 
                        class="px-6 py-3 rounded-full text-lg transition-all {{ $currentGender === 'femme' ? 'bg-teal-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Pour Femmes
                    </a>
                    <a href="{{ auth()->check() ? route('product.private', ['gender' => 'homme']) : route('product.public', ['gender' => 'homme']) }}" 
                        class="px-6 py-3 rounded-full text-lg transition-all {{ $currentGender === 'homme' ? 'bg-teal-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Pour Hommes
                    </a>
                </div>
            </div>

            <!-- Category Navigation -->
            <div class="mb-12">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($categories as $categoryKey => $categoryName)
                        <div class="relative">
                            @php
                                $hasSubcategories = in_array($categoryKey, [Product::CATEGORY_MAQUILLAGE, Product::CATEGORY_FRAGRANCE]);
                                $routeName = auth()->check() ? 'product.private.category' : 'product.public.category';
                                $subRouteName = auth()->check() ? 'product.private.subcategory' : 'product.public.subcategory';
                            @endphp
                            
                            <a href="{{ route($routeName, ['gender' => $currentGender, 'category' => $categoryKey]) }}" 
                                @if($hasSubcategories)
                                    data-category="{{ $categoryKey }}"
                                    class="modern-card group has-subcategories {{ $category === $categoryKey ? 'active' : '' }}"
                                @else
                                    class="modern-card group {{ $category === $categoryKey ? 'active' : '' }}"
                                @endif
                            >
                                <div class="card-content">
                                    <h3 class="card-title">{{ $categoryName }}</h3>
                                    <div class="card-line"></div>
                                    @if($hasSubcategories)
                                        <div class="mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto text-gray-400 group-hover:text-teal-500 transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            
                            <!-- Subcategories Panel (only for categories with subcategories) -->
                            @if($hasSubcategories && isset($subcategories[$categoryKey]) && count($subcategories[$categoryKey]) > 0)
                                <div id="subcategories-{{ $categoryKey }}" class="subcategories-panel hidden absolute left-0 right-0 mt-2 bg-white rounded-xl shadow-lg z-50 transform transition-all duration-300 opacity-0">
                                    <div class="p-4 space-y-2">
                                        @foreach($subcategories[$categoryKey] as $subKey => $subName)
                                            <a href="{{ route($subRouteName, ['gender' => $currentGender, 'category' => $categoryKey, 'subcategory' => $subKey]) }}" 
                                               class="block px-4 py-2 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors duration-200 {{ $subcategory === $subKey ? 'bg-teal-50 text-teal-600' : '' }}">
                                                {{ $subName }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="products-container">
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
            </div>

            <!-- More Products Section -->
            @if($hasMore)
            <div class="mt-12 text-center">
                <button id="load-more" 
                        class="bg-white border-2 border-teal-600 text-teal-600 hover:bg-teal-600 hover:text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 shadow-md hover:shadow-lg"
                        data-page="{{ $currentPage + 1 }}"
                        onclick="loadMoreProducts(this)">
                    Load More Products
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

        /* Modern card styles */
        .modern-card {
            @apply relative overflow-hidden rounded-2xl transition-all duration-500 
                   bg-gradient-to-br from-white/80 to-white/40 backdrop-blur-lg
                   border border-white/20 shadow-[0_8px_20px_rgba(0,0,0,0.06)]
                   hover:shadow-[0_15px_30px_rgba(0,0,0,0.1)] hover:-translate-y-1;
        }

        .card-content {
            @apply relative p-6 flex flex-col items-center text-center z-10;
        }

        .card-title {
            @apply text-lg font-semibold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent
                   transition-all duration-300 group-hover:from-teal-600 group-hover:to-teal-800;
        }

        .card-line {
            @apply w-12 h-0.5 my-3 bg-gradient-to-r from-teal-500 to-teal-600 rounded-full
                   transition-all duration-300 group-hover:w-24 group-hover:from-teal-400 group-hover:to-teal-600;
        }

        .modern-card.active {
            @apply bg-gradient-to-br from-teal-500 to-teal-600 border-teal-400/20
                   shadow-[0_8px_20px_rgba(13,148,136,0.2)];
        }

        .modern-card.active .card-title {
            @apply from-white to-white/90;
        }

        .modern-card.active .card-line {
            @apply from-white to-white/80;
        }

        .subcategories-panel.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .subcategories-panel {
            transform: translateY(-10px);
        }

        .modern-card.has-subcategories {
            cursor: pointer;
        }
    </style>

    <script>
        function showMoreProducts() {
            const hiddenProducts = document.querySelectorAll('.more-products');
            hiddenProducts.forEach((product, index) => {
                setTimeout(() => {
                    product.classList.remove('hidden');
                    product.classList.add('animate-fadeIn');
                }, index * 100);
            });
            
            const button = event.target;
            button.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                button.style.display = 'none';
            }, 300);
        }
        
        function flipCard(button) {
            const card = button.closest('.flip-card');
            card.classList.toggle('flipped');
            
            // Close other cards
            document.querySelectorAll('.flip-card').forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('flipped');
                }
            });
        }

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

        document.addEventListener('DOMContentLoaded', function() {
            initializeCart();
            updateCartCount();
            const categories = document.querySelectorAll('.modern-card.has-subcategories');
            let activePanel = null;

            categories.forEach(category => {
                category.addEventListener('click', function(e) {
                    e.preventDefault();
                    const categoryKey = this.dataset.category;
                    const panel = document.getElementById(`subcategories-${categoryKey}`);
                    
                    if (!panel) return; // Skip if no panel exists
                    
                    // If clicking the same category
                    if (activePanel === panel) {
                        // Toggle the panel
                        if (panel.classList.contains('show')) {
                            hidePanel(panel);
                            activePanel = null;
                        } else {
                            showPanel(panel);
                        }
                    } else {
                        // Hide previous panel if exists
                        if (activePanel) {
                            hidePanel(activePanel);
                        }
                        
                        // Show new panel
                        showPanel(panel);
                        activePanel = panel;
                    }
                });
            });

            // Close panel when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.modern-card.has-subcategories') && !e.target.closest('.subcategories-panel')) {
                    if (activePanel) {
                        hidePanel(activePanel);
                        activePanel = null;
                    }
                }
            });

            function showPanel(panel) {
                panel.classList.remove('hidden');
                setTimeout(() => {
                    panel.classList.add('show');
                }, 10);
            }

            function hidePanel(panel) {
                panel.classList.remove('show');
                setTimeout(() => {
                    panel.classList.add('hidden');
                }, 300);
            }
        });

        function loadMoreProducts(button) {
            const page = button.dataset.page;
            const container = document.getElementById('products-container');
            const currentUrl = new URL(window.location.href);
            
            currentUrl.searchParams.set('page', page);

            fetch(currentUrl.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Parse the HTML string into DOM elements
                const tempContainer = document.createElement('div');
                tempContainer.innerHTML = data.html;
                
                // Add each new product card to the container
                const newCards = tempContainer.children;
                Array.from(newCards).forEach(card => {
                    container.appendChild(card);
                });
                
                if (data.hasMore) {
                    button.dataset.page = parseInt(page) + 1;
                } else {
                    button.style.display = 'none';
                }
            });
        }

        function initializeCart() {
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            
            if (!localStorage.getItem(cartKey)) {
                localStorage.setItem(cartKey, JSON.stringify({}));
            }
        }

        function addToCart(productId, productName, productPrice, productImage = null) {
            @if(!auth()->check())
                window.location.href = "{{ route('login') }}";
                return;
            @endif

            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            let cart = JSON.parse(localStorage.getItem(cartKey)) || {};
            
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
            
            setTimeout(() => {
                notification.classList.remove('translate-y-10', 'opacity-0');
                notification.classList.add('translate-y-0', 'opacity-100');
            }, 10);
            
            setTimeout(() => {
                notification.classList.remove('translate-y-0', 'opacity-100');
                notification.classList.add('translate-y-10', 'opacity-0');
                
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
    </script>
</x-app-layout>