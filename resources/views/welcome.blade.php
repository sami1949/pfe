<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EleganceVibe</title>
    
    <!-- Fonts and external resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Styles -->
    <style>
        /* Base styles */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            color: #333;
        }
        
        /* Content sections */
        section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #f8e8e8;
        }
        
        /* Container for content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Services section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .service-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
        }
        
        .service-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        
        .service-content {
            padding: 20px;
        }
        
        .service-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        /* Products section */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .product-card:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        
        .product-img {
            height: 250px;
            width: 100%;
            object-fit: cover;
        }
        
        .product-info {
            padding: 15px;
        }
        
        .product-name {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .product-price {
            font-weight: bold;
            color: #333;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
                margin-bottom: 40px;
            }
            
            .services-grid,
            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
    <!-- Include navigation -->
    @include('layouts/navigation')
    
    <main>
        <!-- Services Section -->
        <section id="services" class="bg-gray-50">
            <div class="container">
                <h2 class="section-title">Nos Services</h2>
                <div class="services-grid">
                    <!-- Service 1 -->
                    <div class="service-card">
                        <img src="/images/service1.jpg" alt="Service 1" class="service-img">
                        <div class="service-content">
                            <h3 class="service-title">Soins Visage</h3>
                            <p>Des soins personnalisés pour sublimer votre peau et révéler son éclat naturel.</p>
                        </div>
                    </div>
                    
                    <!-- Service 2 -->
                    <div class="service-card">
                        <img src="/images/service2.jpg" alt="Service 2" class="service-img">
                        <div class="service-content">
                            <h3 class="service-title">Massage Relaxant</h3>
                            <p>Détendez-vous avec nos techniques de massage expertes pour un bien-être total.</p>
                        </div>
                    </div>
                    
                    <!-- Service 3 -->
                    <div class="service-card">
                        <img src="/images/service3.jpg" alt="Service 3" class="service-img">
                        <div class="service-content">
                            <h3 class="service-title">Épilage Professionnel</h3>
                            <p>Des méthodes douces et efficaces pour une peau parfaitement lisse.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Products Section -->
        <section id="products">
            <div class="container">
                <h2 class="section-title">Nos Produits</h2>
                <div class="products-grid">
                    <!-- Product 1 -->
                    @foreach($products as $product)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}"
                            class="w-full h-48 object-cover mb-4 rounded-lg">
                        @endif
                        
                        <h3 class="text-xl font-semibold text-gray-900">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                        
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-2xl font-bold text-indigo-600">{{ number_format($product->price, 2) }}€</span>
                            <a href="#" 
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                    
                    <!-- Product 2 -->
                    <div class="product-card">
                        <img src="/images/product2.jpg" alt="Product 2" class="product-img">
                        <div class="product-info">
                            <h3 class="product-name">Sérum Éclat</h3>
                            <p class="product-price">$60.00</p>
                        </div>
                    </div>
                    
                    <!-- Product 3 -->
                    <div class="product-card">
                        <img src="/images/product3.jpg" alt="Product 3" class="product-img">
                        <div class="product-info">
                            <h3 class="product-name">Masque Nourrissant</h3>
                            <p class="product-price">$35.00</p>
                        </div>
                    </div>
                    
                    <!-- Product 4 -->
                    <div class="product-card">
                        <img src="/images/product4.jpg" alt="Product 4" class="product-img">
                        <div class="product-info">
                            <h3 class="product-name">Huile Essentielle</h3>
                            <p class="product-price">$28.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        function smoothScroll(target) {
            const element = document.getElementById(target);
            element.scrollIntoView({ 
                behavior: 'smooth' 
            });
        }
    </script>
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
</body>
</html>