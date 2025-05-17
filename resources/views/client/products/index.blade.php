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
                    <a href="{{ route('product.private', ['gender' => 'femme']) }}" 
                       class="px-6 py-3 rounded-full text-lg transition-all {{ $currentGender === 'femme' ? 'bg-teal-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Pour Femmes
                    </a>
                    <a href="{{ route('product.private', ['gender' => 'homme']) }}" 
                       class="px-6 py-3 rounded-full text-lg transition-all {{ $currentGender === 'homme' ? 'bg-teal-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        Pour Hommes
                    </a>
                </div>
            </div>

            <!-- Category Navigation -->
            <div class="mb-12">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($categories as $categoryKey => $categoryName)
                        <a href="{{ route('product.private', ['gender' => $currentGender, 'category' => $categoryKey]) }}" 
                           class="modern-card group {{ $category === $categoryKey ? 'active' : '' }}">
                            <div class="card-content">
                                <h3 class="card-title">{{ $categoryName }}</h3>
                                <div class="card-line"></div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="products-container">
                @foreach($products as $product)
                    <div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-[28rem] relative group">
                        <div class="product-image-container h-64 overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 mt-2 line-clamp-2">{{ $product->description }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-2xl font-bold text-teal-600">{{ number_format($product->price, 2) }}€</span>
                                <button onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', {{ $product->price }}, '{{ $product->image }}')" 
                                        class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition-colors duration-300 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- More Products Section -->
            @if($hasMore)
            <div class="mt-12">
                <button id="load-more" 
                        class="mx-auto block bg-white text-teal-600 px-8 py-3 rounded-full border border-teal-600 hover:bg-teal-50 transition-colors"
                        data-page="{{ $currentPage + 1 }}"
                        onclick="loadMoreProducts(this)">
                    Load More Products
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
        /* ===== Luxury Beauty Category Cards ===== */
.modern-card {
  position: relative;
  overflow: hidden;
  border-radius: 20px;
  padding: 2.5rem 2rem;
  height: 260px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  transition: all 0.5s cubic-bezier(0.22, 1, 0.36, 1);
  cursor: pointer;
  background: rgba(255, 255, 255, 0.75);
  backdrop-filter: blur(12px) saturate(120%);
  -webkit-backdrop-filter: blur(12px) saturate(120%);
  border: 1px solid rgba(255, 255, 255, 0.4);
  box-shadow: 
    0 10px 25px -5px rgba(0, 0, 0, 0.03),
    0 5px 15px -5px rgba(0, 0, 0, 0.05),
    inset 0 -1px 1px rgba(255, 255, 255, 0.5),
    inset 0 1px 1px rgba(255, 255, 255, 0.8);
  z-index: 1;
  transform-style: preserve-3d;
  perspective: 1000px;
}

/* === Ultra-Premium Hover Effect (3D Tilt + Shadow Lift) === */
.modern-card:hover {
  transform: translateY(-8px) rotateX(2deg) rotateY(1deg);
  box-shadow: 
    0 20px 40px -10px rgba(0, 0, 0, 0.1),
    0 10px 20px -10px rgba(0, 0, 0, 0.08),
    inset 0 -1px 1px rgba(255, 255, 255, 0.6),
    inset 0 1px 1px rgba(255, 255, 255, 0.9);
  background: rgba(255, 255, 255, 0.85);
}

/* === Active State (Like "Selected" in a Luxury Store) === */
.modern-card.active {
  background: rgba(255, 255, 255, 0.9);
  border: 1px solid rgba(210, 180, 140, 0.4); /* Gold-like border */
  box-shadow: 
    0 15px 30px -5px rgba(0, 0, 0, 0.1),
    inset 0 0 0 1px rgba(210, 180, 140, 0.3); /* Subtle gold inset */
}

/* === Pearl/Gold Accent Glow (On Hover) === */
.modern-card::before {
  content: "";
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(
    circle at center,
    rgba(255, 235, 205, 0.15) 0%,
    rgba(255, 255, 255, 0) 70%
  );
  opacity: 0;
  transition: opacity 0.6s ease;
  z-index: -1;
}

.modern-card:hover::before {
  opacity: 1;
}

/* === Couture-Inspired Icon Container (Like a Jewel) === */
.card-icon-wrapper {
  width: 70px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.25rem;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  box-shadow: 
    0 4px 15px rgba(0, 0, 0, 0.03),
    inset 0 2px 2px rgba(255, 255, 255, 0.8),
    inset 0 -1px 2px rgba(0, 0, 0, 0.05);
  transition: all 0.5s cubic-bezier(0.22, 1, 0.36, 1);
  position: relative;
  overflow: hidden;
}

.card-icon-wrapper::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.8) 0%,
    rgba(255, 255, 255, 0) 100%
  );
  border-radius: 50%;
}

.modern-card:hover .card-icon-wrapper {
  transform: scale(1.1) translateY(-5px);
  box-shadow: 
    0 6px 20px rgba(0, 0, 0, 0.08),
    inset 0 3px 3px rgba(255, 255, 255, 0.9),
    inset 0 -1px 2px rgba(0, 0, 0, 0.05);
}

/* === High-End Serif Typography (Editorial Style) === */
.card-title {
  font-family: "Playfair Display", serif;
  font-size: 1.4rem;
  font-weight: 600;
  margin-bottom: 0.75rem;
  color: #2a2118; /* Deep taupe for luxury feel */
  letter-spacing: 0.5px;
  transition: all 0.4s ease;
  position: relative;
  display: inline-block;
}

.modern-card:hover .card-title {
  color: #1a1815; /* Even deeper on hover */
}

/* === Floating Underline (Like Perfume Label) === */
.card-title::after {
  content: "";
  position: absolute;
  bottom: -5px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 1px;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(210, 180, 140, 0.8) 50%,
    transparent 100%
  );
  transition: width 0.4s ease;
}

.modern-card:hover .card-title::after {
  width: 60%;
}

/* === Micro-Description (Subtle & Elegant) === */
.card-description {
  font-family: "Cormorant Garamond", serif;
  font-size: 0.9rem;
  color: #5a534a;
  opacity: 0.8;
  letter-spacing: 0.3px;
  line-height: 1.5;
  transition: all 0.4s ease;
  max-width: 80%;
  margin: 0 auto;
}

.modern-card:hover .card-description {
  opacity: 1;
  color: #4a4238;
}

/* === "NEW" Badge (Like a Wax Seal) === */
.new-badge {
  position: absolute;
  top: 1.2rem;
  right: 1.2rem;
  font-family: "Cormorant SC", serif;
  font-size: 0.7rem;
  font-weight: 600;
  padding: 0.3rem 0.6rem;
  border-radius: 12px;
  background: linear-gradient(
    135deg,
    rgba(210, 180, 140, 0.9) 0%,
    rgba(210, 180, 140, 0.7) 100%
  );
  color: #2a2118;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
  letter-spacing: 1px;
  text-transform: uppercase;
}

/* === "SALE" Card Special Styling (Luxury Red) === */
.sale-card {
  background: rgba(254, 226, 226, 0.7);
  border: 1px solid rgba(239, 187, 187, 0.4);
}

.sale-card:hover {
  background: rgba(254, 226, 226, 0.85);
}

.sale-badge {
  background: linear-gradient(
    135deg,
    rgba(185, 28, 28, 0.9) 0%,
    rgba(185, 28, 28, 0.7) 100%
  );
  color: white;
  font-family: "Cormorant SC", serif;
  letter-spacing: 1px;
}

/* ===== Mobile Responsiveness ===== */
@media (max-width: 1024px) {
  .modern-card {
    height: 220px;
    padding: 2rem 1.5rem;
  }
  
  .card-icon-wrapper {
    width: 60px;
    height: 60px;
  }
  
  .card-title {
    font-size: 1.2rem;
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
                // Append new products
                container.insertAdjacentHTML('beforeend', data.html);
                
                // Update button
                if (data.hasMore) {
                    button.dataset.page = parseInt(page) + 1;
                } else {
                    button.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>