@php
    use App\Models\Product;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4">
            <h2 class="font-bold text-2xl md:text-3xl text-gray-800">
                {{ __('Nos Produits') }} 
                @if($currentGender)
                    <span class="text-[#886666]">- {{ ucfirst($currentGender) }}</span>
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
                        class="px-6 py-3 rounded-full text-lg transition-all {{ $currentGender === 'femme' ? 'bg-[#f8e8e8] text-gray-800 shadow-lg' : 'bg-white text-gray-700 hover:bg-[#f8e8e8] border border-gray-200' }}">
                        Pour Femmes
                    </a>
                    <a href="{{ auth()->check() ? route('product.private', ['gender' => 'homme']) : route('product.public', ['gender' => 'homme']) }}" 
                        class="px-6 py-3 rounded-full text-lg transition-all {{ $currentGender === 'homme' ? 'bg-[#f8e8e8] text-gray-800 shadow-lg' : 'bg-white text-gray-700 hover:bg-[#f8e8e8] border border-gray-200' }}">
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
        <div class="flex items-center justify-center gap-2">
            <h3 class="card-title">{{ $categoryName }}</h3>
            @if($hasSubcategories)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-[#c0a8a8] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            @endif
        </div>
        <div class="card-line"></div>
    </div>
</a>
                            
                            <!-- Subcategories Panel -->
                            @if($hasSubcategories && isset($subcategories[$categoryKey]) && count($subcategories[$categoryKey]) > 0)
                                <div id="subcategories-{{ $categoryKey }}" class="subcategories-panel hidden absolute left-0 right-0 mt-2 bg-white rounded-xl shadow-lg z-50 transform transition-all duration-300 opacity-0 border border-[#f8e8e8]">
                                    <div class="p-4 space-y-2">
                                        @foreach($subcategories[$categoryKey] as $subKey => $subName)
                                            <a href="{{ route($subRouteName, ['gender' => $currentGender, 'category' => $categoryKey, 'subcategory' => $subKey]) }}" 
                                                class="block px-4 py-2 text-gray-700 hover:bg-[#f8e8e8] hover:text-gray-800 rounded-lg transition-colors duration-200 {{ $subcategory === $subKey ? 'bg-[#f8e8e8] text-gray-800' : '' }}">
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
                <div class="product-card">
                    <div class="flip-card-inner">
                        <!-- Front of the card -->
                        <div class="flip-card-front">
                            @if($product->image)
                            <div class="product-image-container">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                    alt="{{ $product->name }}"
                                    class="product-image">
                                <div class="image-overlay"></div>
                            </div>
                            @endif
                            
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <p class="product-description">{{ $product->description }}</p>
                            
                            <div class="product-footer">
                                <span class="product-price">{{ number_format($product->price, 2) }}€</span>
                                <button onclick="flipCard(this)" class="details-button">
                                    Details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="button-icon" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Back of the card -->
                        <div class="flip-card-back">
                            <h3 class="product-name-back">{{ $product->name }}</h3>
                            
                            <div class="product-details">
                                @if($product->description1)
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="detail-text">{{ $product->description1 }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($product->description2)
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="detail-text">{{ $product->description2 }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($product->description3)
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="detail-text">{{ $product->description3 }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($product->brand)
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h14l-4 10H9L5 5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="detail-text">Marque: {{ $product->brand }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="product-actions">
                                <span class="product-price-back">{{ number_format($product->price, 2) }}€</span>
                                <div class="action-buttons">
                                    <button onclick="flipCard(this)" class="back-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="button-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        Back
                                    </button>
                                    
                                    @auth
                                    <button onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', {{ $product->price }}, '{{ $product->image }}')" class="add-to-cart-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="button-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                        </svg>
                                        Add to Cart
                                    </button>
                                    @else
                                    <a href="{{ route('login') }}" class="login-button">
                                        <svg class="button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                @endforeach
            </div>

            <!-- More Products Section -->
            @if($hasMore)
            <div class="mt-12 text-center">
                <button id="load-more" 
                        class="load-more-button"
                        data-page="{{ $currentPage + 1 }}"
                        onclick="loadMoreProducts(this)">
                    Load More Products
                    <svg xmlns="http://www.w3.org/2000/svg" class="load-more-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            @endif
        </div>
    </div>

    <style>
        /* Base Product Card Styles - Applied to ALL product cards */
        .product-card {
            perspective: 1200px;
            background-color: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 8px 25px -8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 28rem;
            position: relative;
            border: 1px solid rgba(248, 232, 232, 0.5);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.15);
        }

        .flip-card-inner {
            transition: transform 0.7s cubic-bezier(0.4, 0.2, 0.2, 1);
            transform-style: preserve-3d;
            position: relative;
            height: 100%;
            width: 100%;
        }

        .product-card.flipped .flip-card-inner {
            transform: rotateY(180deg);
        }

        /* Front and Back Card Styles */
        .flip-card-front, .flip-card-back {
            backface-visibility: hidden;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .flip-card-front {
            z-index: 2;
            transform: rotateY(0deg);
            background-color: white;
        }

        .flip-card-back {
            transform: rotateY(180deg);
            background-color: #f8e8e8;
            border-radius: 1rem;
        }

        /* Image Styles */
        .product-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
            height: 14rem;
            margin-bottom: 1rem;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.1), transparent);
        }

        /* Text Styles - Consistent across all cards */
        .product-name, .product-name-back {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .product-description {
            color: #6b7280;
            margin-top: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }

        /* Price Styles - Made identical for front and back */
        .product-price, .product-price-back {
            font-size: 1.5rem;
            font-weight: 700;
            color: #886666 !important;
        }

        .product-footer {
            margin-top: 1rem;
            padding-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Back Card Specific Styles */
        .product-details {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            background-color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .detail-icon {
            background-color: #f8e8e8;
            padding: 0.25rem;
            border-radius: 9999px;
            margin-right: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon {
            height: 1.25rem;
            width: 1.25rem;
            color: #1f2937;
        }

        .detail-text {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .product-actions {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        /* Button Styles - Consistent across all cards */
        .details-button, .back-button, 
        .add-to-cart-button, .login-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1.25rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            font-size: 0.875rem;
            background-color: #f8e8e8;
            color: #886666 !important;
        }

        .details-button:hover, .add-to-cart-button:hover, 
        .login-button:hover, .back-button:hover {
            background-color: #f0d8d8;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Icon Styles - Made consistent */
        .button-icon, .icon {
            height: 1.25rem;
            width: 1.25rem;
            color: #886666 !important;
        }

        .button-icon {
            margin-right: 0.25rem;
        }

        /* Load More Button */
        .load-more-button {
            background-color: #f8e8e8;
            color: #886666 !important;
            border: none;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: inline-flex;
            align-items: center;
        }

        .load-more-button:hover {
            background-color: #f0d8d8;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .load-more-icon {
            height: 1.25rem;
            width: 1.25rem;
            margin-left: 0.5rem;
            color: #886666 !important;
        }

        /* Modern card styles */
        .modern-card {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            transition: all 0.5s ease;
            background: linear-gradient(to bottom right, rgba(255,255,255,0.9), rgba(255,255,255,0.7));
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }

        .modern-card:hover {
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            transform: translateY(-1px);
        }

        .card-content {
            position: relative;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            z-index: 10;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #555;
            transition: all 0.3s ease;
        }

        .modern-card:hover .card-title {
            color: #886666;
        }

        .card-line {
            width: 3rem;
            height: 0.125rem;
            margin: 0.75rem 0;
            background: linear-gradient(to right, #f8e8e8, #e8d8d8);
            border-radius: 9999px;
            transition: all 0.3s ease;
        }

        .modern-card:hover .card-line {
            width: 6rem;
            background: linear-gradient(to right, #f0d8d8, #e8c8c8);
        }

        .modern-card.active {
            background: linear-gradient(to bottom right, #f8e8e8, #f0e0e0);
            border-color: #e8d8d8;
            box-shadow: 0 8px 20px rgba(248,232,232,0.3);
        }

        .modern-card.active .card-title {
            color: #555;
        }

        .modern-card.active .card-line {
            background: linear-gradient(to right, #e8d0d0, #e0c8c8);
        }

        .subcategories-panel.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .subcategories-panel {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
            border: 1px solid rgba(248, 232, 232, 0.5);
            transition: all 0.3s ease;
        }

        .modern-card.has-subcategories {
            cursor: pointer;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .loaded-product {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>

    <script>
        function flipCard(button) {
            const card = button.closest('.product-card');
            if (!card) return;
            
            card.classList.toggle('flipped');
            
            // Fermer les autres cartes
            document.querySelectorAll('.product-card').forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('flipped');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeCart();
            updateCartCount();
            
            // Gestion des sous-catégories
            const categories = document.querySelectorAll('.modern-card.has-subcategories');
            let activePanel = null;

            categories.forEach(category => {
                category.addEventListener('click', function(e) {
                    e.preventDefault();
                    const categoryKey = this.dataset.category;
                    const panel = document.getElementById(`subcategories-${categoryKey}`);
                    
                    if (!panel) return;
                    
                    if (activePanel === panel) {
                        // Si le même panneau est déjà actif, on le ferme
                        if (panel.classList.contains('show')) {
                            hidePanel(panel);
                            activePanel = null;
                        } else {
                            showPanel(panel);
                        }
                    } else {
                        // Si un autre panneau est actif, on le ferme d'abord
                        if (activePanel) {
                            hidePanel(activePanel);
                        }
                        showPanel(panel);
                        activePanel = panel;
                    }
                });
            });

            // Fermer le panneau actif si on clique en dehors
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

            // Observer pour les nouvelles cartes
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.addedNodes.length) {
                        mutation.addedNodes.forEach((node) => {
                            if (node.nodeType === 1 && node.classList.contains('product-card')) {
                                if (!node.classList.contains('hover-effect')) {
                                    node.classList.add('hover-effect');
                                }
                            }
                        });
                    }
                });
            });

            observer.observe(document.getElementById('products-container'), {
                childList: true,
                subtree: true
            });
        });

        // Styles pour les sous-catégories
        const subcategoriesStyle = document.createElement('style');
        subcategoriesStyle.textContent = `
            .subcategories-panel {
                transform: translateY(-10px);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .subcategories-panel.show {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }

            .subcategories-panel.hidden {
                display: none;
            }
        `;
        document.head.appendChild(subcategoriesStyle);

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
                // Ajouter directement le HTML au conteneur
                container.insertAdjacentHTML('beforeend', data.html);

                // Mettre à jour le bouton
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
            
            // Vérifier si l'utilisateur a changé
            const lastUserId = localStorage.getItem('last_user_id');
            if (lastUserId !== userId) {
                // Nettoyer tous les anciens paniers
                Object.keys(localStorage).forEach(key => {
                    if (key.startsWith('cart_')) {
                        localStorage.removeItem(key);
                    }
                });
                // Enregistrer le nouvel ID utilisateur
                localStorage.setItem('last_user_id', userId);
            }
            
            // Initialiser le panier pour l'utilisateur actuel
            if (!localStorage.getItem(cartKey)) {
                localStorage.setItem(cartKey, JSON.stringify({}));
            }

            // Mettre à jour le compteur du panier
            updateCartCount();
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

            let userId = "{{ auth()->id() }}";
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
            notification.className = 'fixed bottom-4 right-4 bg-[#f8e8e8] text-gray-800 px-6 py-3 rounded-lg shadow-lg transform translate-y-10 opacity-0 transition-all duration-300 border border-[#f8e8e8]';
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

        // Ajouter un écouteur d'événements pour la visibilité de la page
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                // Réinitialiser le panier quand la page devient visible
                initializeCart();
            }
        });
    </script>
</x-app-layout> 