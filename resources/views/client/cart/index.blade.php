<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4">
            <h2 class="font-bold text-2xl md:text-3xl text-gray-800">
                {{ __('Your Shopping Cart') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Empty Cart State -->
            <div id="empty-cart" class="{{ count($cartItems) === 0 ? '' : 'hidden' }} text-center py-20">
                <!-- ... keep the empty cart HTML ... -->
            </div>

            <!-- Cart with Items -->
            <div id="cart-with-items" class="{{ count($cartItems) > 0 ? '' : 'hidden' }}">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Cart Items -->
                    <div class="lg:w-2/3">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                            <div class="p-6 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-800">Your Items ({{ count($cartItems) }})</h3>
                            </div>
                            
                            <div id="cart-items-container" class="divide-y divide-gray-100">
                                @foreach($cartItems as $productId => $product)
                                <div class="cart-item p-6 transition-colors" data-product-id="{{ $productId }}">
                                    <div class="flex flex-col md:flex-row gap-6">
                                        <!-- Product Image -->
                                        <div class="w-full md:w-32 h-32 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                                            @if(isset($product['image']))
                                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Product Details -->
                                        <div class="flex-grow">
                                            <div class="flex justify-between">
                                                <div>
                                                    <h4 class="text-lg font-medium text-gray-800">{{ $product['name'] }}</h4>
                                                    <p class="text-teal-600 font-semibold mt-1">€{{ number_format($product['price'], 2) }}</p>
                                                </div>
                                                <button onclick="removeFromCart('{{ $productId }}')" class="delete-btn text-gray-400 hover:text-red-500 h-8 w-8 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="trash-icon h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                            
                                            <div class="mt-4 flex items-center justify-between">
                                                <!-- Quantity Selector -->
                                                <div class="flex items-center">
                                                    <button onclick="updateQuantity('{{ $productId }}', -1)" class="quantity-btn rounded-l-lg">-</button>
                                                    <input type="number" value="{{ $product['quantity'] }}" min="1" 
                                                        onchange="updateQuantityInput('{{ $productId }}', this)" 
                                                        class="quantity-input">
                                                    <button onclick="updateQuantity('{{ $productId }}', 1)" class="quantity-btn rounded-r-lg">+</button>
                                                </div>
                                                
                                                <span class="text-lg font-semibold text-gray-800">€{{ number_format($product['price'] * $product['quantity'], 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="lg:w-1/3">
                        <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Order Summary</h3>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span id="subtotal" class="font-medium">€{{ number_format(array_reduce($cartItems, function($carry, $item) {
                                        return $carry + ($item['price'] * $item['quantity']);
                                    }, 0), 2) }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium text-teal-600">Free</span>
                                </div>
                                
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-800 font-semibold">Total</span>
                                        <span id="total" class="text-xl font-bold text-teal-600">€{{ number_format(array_reduce($cartItems, function($carry, $item) {
                                            return $carry + ($item['price'] * $item['quantity']);
                                        }, 0), 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <button id="checkout-btn" class="mt-8 w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium py-3 px-6 rounded-lg transition-all shadow-md hover:from-teal-600 hover:to-teal-700 hover:shadow-lg">
                                Proceed to Checkout
                            </button>
                            
                            <div class="mt-4 text-center text-sm text-gray-500">
                                or <a href="{{ route('product.private') }}" class="text-teal-600 hover:text-teal-700 font-medium">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .quantity-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .quantity-btn:hover {
            background-color: #e5e7eb;
        }
        
        .quantity-input {
            width: 40px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            border-left: none;
            border-right: none;
            -moz-appearance: textfield;
        }
        
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .delete-btn:hover .trash-icon {
            transform: scale(1.1);
        }
        
        .trash-icon {
            transition: transform 0.2s;
        }
        
        .cart-item:hover {
            background-color: #f9fafb;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadCartItems();
            // Handle checkout button
            document.getElementById('checkout-btn').addEventListener('click', function(e) {
                e.preventDefault();
                
                let userId = "{{ auth()->id() ?? 'guest' }}";
                let cartKey = `cart_${userId}`;
                let cart = JSON.parse(localStorage.getItem(cartKey)) || {};
                
                if (Object.keys(cart).length === 0) {
                    showNotification('Your cart is empty');
                    return;
                }

                // Store cart data in sessionStorage before redirecting
                sessionStorage.setItem('checkoutCart', JSON.stringify(cart));
                
                // Redirect to checkout page
                window.location.href = "{{ route('checkout') }}";
            });
        });

        function createCheckoutFormAndSubmit(cart) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('checkout.process') }}";
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = "{{ csrf_token() }}";
            form.appendChild(csrf);
            
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'cart_data';
            input.value = JSON.stringify(cart);
            form.appendChild(input);
            
            document.body.appendChild(form);
            form.submit();
        }

        function loadCartItems() {
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            let cart = JSON.parse(localStorage.getItem(cartKey)) || {};

            updateCartCount();
            
            if (Object.keys(cart).length === 0) {
                document.getElementById('empty-cart').classList.remove('hidden');
                document.getElementById('cart-with-items').classList.add('hidden');
                return;
            }
            
            document.getElementById('empty-cart').classList.add('hidden');
            document.getElementById('cart-with-items').classList.remove('hidden');
            
            let cartItemsContainer = document.getElementById('cart-items-container');
            cartItemsContainer.innerHTML = '';
            
            let subtotal = 0;
            
            for (let productId in cart) {
                let product = cart[productId];
                let itemTotal = product.price * product.quantity;
                subtotal += itemTotal;
                
                let cartItem = document.createElement('div');
                cartItem.className = 'cart-item p-6 transition-colors';
                cartItem.dataset.productId = productId;
                cartItem.innerHTML = `
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Product Image -->
                        <div class="w-full md:w-32 h-32 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                            ${product.image ? 
                                `<img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover">` : 
                                `<div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>`
                            }
                        </div>
                        
                        <!-- Product Details -->
                        <div class="flex-grow">
                            <div class="flex justify-between">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-800">${product.name}</h4>
                                    <p class="text-teal-600 font-semibold mt-1">€${product.price.toFixed(2)}</p>
                                </div>
                                <button onclick="removeFromCart('${productId}')" class="delete-btn text-gray-400 hover:text-red-500 h-8 w-8 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="trash-icon h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="mt-4 flex items-center justify-between">
                                <!-- Quantity Selector -->
                                <div class="flex items-center">
                                    <button onclick="updateQuantity('${productId}', -1)" class="quantity-btn rounded-l-lg">-</button>
                                    <input type="number" value="${product.quantity}" min="1" 
                                        onchange="updateQuantityInput('${productId}', this)" 
                                        class="quantity-input">
                                    <button onclick="updateQuantity('${productId}', 1)" class="quantity-btn rounded-r-lg">+</button>
                                </div>
                                
                                <span class="text-lg font-semibold text-gray-800">€${itemTotal.toFixed(2)}</span>
                            </div>
                        </div>
                    </div>
                `;
                
                cartItemsContainer.appendChild(cartItem);
            }
            
            // Update totals
            document.getElementById('subtotal').textContent = `€${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `€${subtotal.toFixed(2)}`;
            
            // Update cart count in navbar
            updateCartCount();
        }

        function updateQuantity(productId, change) {
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            let cart = JSON.parse(localStorage.getItem(cartKey)) || {};
            
            if (cart[productId]) {
                cart[productId].quantity += change;
                
                // Ensure quantity doesn't go below 1
                if (cart[productId].quantity < 1) {
                    cart[productId].quantity = 1;
                }
                
                localStorage.setItem(cartKey, JSON.stringify(cart));
                loadCartItems();
            }
        }

        function updateQuantityInput(productId, input) {
            let newQuantity = parseInt(input.value);
            if (isNaN(newQuantity) || newQuantity < 1) {
                newQuantity = 1;
                input.value = 1;
            }
            
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            let cart = JSON.parse(localStorage.getItem(cartKey)) || {};
            
            if (cart[productId]) {
                cart[productId].quantity = newQuantity;
                localStorage.setItem(cartKey, JSON.stringify(cart));
                loadCartItems();
            }
        }

        function removeFromCart(productId) {
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            let cart = JSON.parse(localStorage.getItem(cartKey)) || {};
            
            if (cart[productId]) {
                delete cart[productId];
                localStorage.setItem(cartKey, JSON.stringify(cart));
                loadCartItems();
                
                // Force update the cart count immediately
                updateCartCount();
        
                // Reload the cart items to show empty state if needed
                loadCartItems();

                // Show notification
                showNotification('Item removed from cart');
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

            // Update cart page count
            const cartItemCountElement = document.getElementById('cart-item-count');
            if (cartItemCountElement) {
                cartItemCountElement.textContent = totalItems;
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