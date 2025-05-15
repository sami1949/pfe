<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4">
            <h2 class="font-bold text-2xl md:text-3xl text-gray-800">
                {{ __('Checkout') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Shipping and Payment Info -->
                <div class="lg:w-2/3">
                    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-800">Shipping Information</h3>
                            </div>
                            
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" id="first_name" name="first_name" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                </div>
                                
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input type="text" id="address" name="address" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                </div>
                                
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input type="text" id="city" name="city" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                </div>
                                
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <input type="text" id="country" name="country" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                            <div class="p-6 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-800">Payment Method</h3>
                            </div>
                            
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="credit_card" name="payment_method" type="radio" value="credit_card" checked
                                            class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300">
                                        <label for="credit_card" class="ml-3 block text-sm font-medium text-gray-700">
                                            Credit Card
                                        </label>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <input id="paypal" name="payment_method" type="radio" value="paypal"
                                            class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300">
                                        <label for="paypal" class="ml-3 block text-sm font-medium text-gray-700">
                                            PayPal
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Credit Card Fields (shown when credit card is selected) -->
                                <div id="credit-card-fields" class="mt-6 space-y-4">
                                    <div>
                                        <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                                        <input type="text" id="card_number" name="card_number"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                            placeholder="4242 4242 4242 4242">
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                            <input type="text" id="expiry_date" name="expiry_date"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                                placeholder="MM/YY">
                                        </div>
                                        
                                        <div>
                                            <label for="cvc" class="block text-sm font-medium text-gray-700 mb-1">CVC</label>
                                            <input type="text" id="cvc" name="cvc"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                                                placeholder="123">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium py-3 px-6 rounded-lg transition-all shadow-md hover:from-teal-600 hover:to-teal-700 hover:shadow-lg">
                            Complete Order
                        </button>
                    </form>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Order Summary</h3>
                        
                        <div id="order-summary" class="space-y-4">
                            <!-- Cart items will be loaded here via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load cart data from sessionStorage
            const cartData = JSON.parse(sessionStorage.getItem('checkoutCart')) || {};
            
            // Update order summary
            const orderSummaryContainer = document.getElementById('order-summary');
            let total = 0;
            
            // Clear existing items
            orderSummaryContainer.innerHTML = '';
            
            // Add each item from cart
            for (const [productId, product] of Object.entries(cartData)) {
                const itemTotal = product.price * product.quantity;
                total += itemTotal;
                
                const itemElement = document.createElement('div');
                itemElement.className = 'flex justify-between';
                itemElement.innerHTML = `
                    <div>
                        <p class="text-gray-800">${product.name} × ${product.quantity}</p>
                        <p class="text-sm text-gray-500">One Size</p>
                    </div>
                    <span class="text-gray-600">€${itemTotal.toFixed(2)}</span>
                `;
                orderSummaryContainer.appendChild(itemElement);
            }
            
            // Add totals section
            const totalsSection = document.createElement('div');
            totalsSection.className = 'border-t border-gray-200 pt-4 mt-4';
            totalsSection.innerHTML = `
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-gray-800">€${total.toFixed(2)}</span>
                </div>
                
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Shipping</span>
                    <span class="text-gray-800">Free</span>
                </div>
                
                <div class="flex justify-between font-semibold text-lg mt-4 pt-4 border-t border-gray-200">
                    <span class="text-gray-800">Total</span>
                    <span class="text-teal-600">€${total.toFixed(2)}</span>
                </div>
            `;
            orderSummaryContainer.appendChild(totalsSection);

            // Add cart data to form submission
            const form = document.getElementById('checkout-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Add cart data to form
                const cartInput = document.createElement('input');
                cartInput.type = 'hidden';
                cartInput.name = 'cart_data';
                cartInput.value = JSON.stringify(cartData);
                this.appendChild(cartInput);
                
                // Submit the form
                this.submit();
            });

            // Toggle credit card fields based on payment method
            const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
            const creditCardFields = document.getElementById('credit-card-fields');
            
            paymentMethods.forEach(method => {
                method.addEventListener('change', function() {
                    if (this.value === 'credit_card') {
                        creditCardFields.classList.remove('hidden');
                    } else {
                        creditCardFields.classList.add('hidden');
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            loadCartItems();
            

            
            // Handle checkout button
            document.getElementById('checkout-btn').addEventListener('click', function(e) {
                //e.preventDefault();

                 // Check if cart is empty
                window.location.href = "{{ route('checkout') }}";
            });
        });

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