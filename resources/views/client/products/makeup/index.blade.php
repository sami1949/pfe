<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4">
            <h2 class="font-bold text-2xl md:text-3xl text-gray-800">
                {{ __('Se Maquiller') }}
                @if($subcategory)
                    <span class="text-teal-600">- {{ ucfirst($subcategory) }}</span>
                @endif
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Subcategory Navigation -->
            <div class="mb-12">
                <!-- Mobile Subcategory Navigation -->
                <div class="lg:hidden">
                    <div class="relative">
                        <select onchange="window.location.href=this.value" class="w-full appearance-none bg-white/80 backdrop-blur-xl px-4 py-3 rounded-2xl border border-white/20 text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent pr-12 shadow-lg">
                            <option value=" " {{ !$subcategory ? 'selected' : '' }}>Tous les produits</option>
                            <option value=" ['subcategory' => 'face']) }}" {{ $subcategory === 'face' ? 'selected' : '' }}>Face</option>
                            <option value=" ['subcategory' => 'lips']) }}" {{ $subcategory === 'lips' ? 'selected' : '' }}>Lips</option>
                            <option value=" ['subcategory' => 'eyes']) }}" {{ $subcategory === 'eyes' ? 'selected' : '' }}>Eyes & Brows</option>
                            <option value=" ['subcategory' => 'tools']) }}" {{ $subcategory === 'tools' ? 'selected' : '' }}>Makeup Tools</option>
                        </select>
                    </div>
                </div>

                <!-- Desktop Subcategory Navigation -->
                <div class="hidden lg:block">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- All Products -->
                        <a href="" class="modern-card group {{ !$subcategory ? 'active' : '' }}">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('storage/products/faceCat.jpg') }}" 
                                     alt="All makeup products" 
                                     class="card-image">
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Tous les produits</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Notre collection complète</p>
                            </div>
                        </a>

                        <!-- Face -->
                        <a href="" class="modern-card group {{ $subcategory === 'face' ? 'active' : '' }}">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('storage/products/faceCat.jpg') }}" 
                                     alt="Face products" 
                                     class="card-image">
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Face</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Foundation & Concealer</p>
                            </div>
                        </a>

                        <!-- Lips -->
                        <a href="" class="modern-card group {{ $subcategory === 'lips' ? 'active' : '' }}">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('storage/products/lipsCat.jpg') }}" 
                                     alt="Lip products" 
                                     class="card-image">
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Lips</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Lipstick & Gloss</p>
                            </div>
                        </a>

                        <!-- Eyes & Brows -->
                        <a href="" class="modern-card group {{ $subcategory === 'eyes' ? 'active' : '' }}">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('storage/products/eyesCat.jpg') }}" 
                                     alt="Eye makeup" 
                                     class="card-image">
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Eyes & Brows</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Mascara & Eyeliners</p>
                            </div>
                        </a>

                        <!-- Makeup Tools -->
                        <a href="" class="modern-card group {{ $subcategory === 'tools' ? 'active' : '' }}">
                            <div class="card-image-wrapper">
                                <img src="{{ asset('storage/products/faceCat.jpg') }}" 
                                     alt="Makeup tools" 
                                     class="card-image">
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Makeup Tools</h3>
                                <div class="card-line"></div>
                                <p class="card-description">Brushes & Accessories</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-[28rem] relative group">
                        <div class="product-image-container h-64 overflow-hidden">
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-teal-600 font-medium text-lg mb-4">{{ $product->formatted_price }}</p>
                            <button onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', {{ $product->price }}, '{{ $product->image_path }}')" 
                                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg transition-colors duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        /* ===== Luxury Image Cards ===== */
        .modern-card {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            height: 320px;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        }

        .card-image-wrapper {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            filter: brightness(0.95);
        }

        .modern-card:hover .card-image {
            transform: scale(1.08);
            filter: brightness(1);
        }

        .card-content {
            padding: 1.5rem;
            position: relative;
            z-index: 2;
            background: linear-gradient(
                to top, 
                rgba(255, 255, 255, 0.95) 60%, 
                rgba(255, 255, 255, 0.7) 100%
            );
        }

        /* Gradient Overlay for Images */
        .card-image-wrapper::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background: linear-gradient(
                to top, 
                rgba(255, 255, 255, 0.7) 0%, 
                transparent 100%
            );
        }

        /* Active State */
        .modern-card.active {
            border: 1px solid rgba(210, 180, 140, 0.5);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .modern-card.active .card-image {
            filter: brightness(1.05);
        }

        /* === High-End Makeup Typography === */
        .card-title {
            font-family: "Cormorant Garamond", serif;
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: #2a2118;
            letter-spacing: 0.3px;
            transition: all 0.5s ease;
            position: relative;
            display: inline-block;
        }

        .card-title::after {
            content: "";
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(
                90deg,
                transparent 0%,
                rgba(200, 160, 120, 0.7) 50%,
                transparent 100%
            );
            transition: width 0.5s ease;
        }

        .modern-card:hover .card-title::after {
            width: 70%;
        }

        .card-description {
            font-family: "Cormorant", serif;
            font-size: 1rem;
            color: #5a534a;
            opacity: 0.85;
            letter-spacing: 0.4px;
            line-height: 1.6;
            transition: all 0.5s ease;
            max-width: 80%;
            margin: 0 auto;
            font-weight: 300;
        }

        /* Product Cards */
        .product-card {
            perspective: 1500px;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .product-card:hover {
            transform: translateY(-8px);
        }

        .product-image-container {
            perspective: 1000px;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .modern-card {
                height: 280px;
            }
        
            .card-image-wrapper {
                height: 160px;
            }
        
            .card-title {
                font-size: 1.4rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeCart();
            updateCartCount();
        });

        function initializeCart() {
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            
            if (!localStorage.getItem(cartKey)) {
                localStorage.setItem(cartKey, JSON.stringify({}));
            }
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