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
            <div class="mb-16">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($categories as $categoryKey => $categoryName)
                        @php
                            $hasSubcategories = in_array($categoryKey, [Product::CATEGORY_MAQUILLAGE, Product::CATEGORY_FRAGRANCE]);
                            $routeName = auth()->check() ? 'product.private.category' : 'product.public.category';
                            $subRouteName = auth()->check() ? 'product.private.subcategory' : 'product.public.subcategory';
                            $isActive = $category === $categoryKey;
                            
                            // Single color scheme for all categories
                            $baseColor = 'bg-gradient-to-br from-[#F9E8E8] to-[#F5D7D7]';
                            $activeColor = 'bg-gradient-to-br from-[#F5D7D7] to-[#F2C9C9] ring-2 ring-[#E8B6B6]';
                            $colorClass = $isActive ? $activeColor : $baseColor;
                        @endphp
                        
                        <div class="relative group" x-data="{ open: false }" 
                            @mouseenter="if({{ $hasSubcategories ? 'true' : 'false' }}) open = true" 
                            @mouseleave="open = false"
                            @click.away="open = false">
                            <!-- Main Category Card -->
                            <div class="block h-full">
                                <a href="{{ route($routeName, ['gender' => $currentGender, 'category' => $categoryKey]) }}"
                                   class="block h-full">
                                    <div class="h-full transition-all duration-300 hover:scale-[1.02] hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)]">
                                        <div class="h-full rounded-xl overflow-hidden border border-[#F0F0F0] shadow-[0_2px_6px_rgba(0,0,0,0.03)] hover:shadow-[0_4px_12px_rgba(0,0,0,0.05)] transition-all duration-300 {{ $colorClass }}">
                                            <div class="h-32 flex items-center justify-center p-4 relative overflow-hidden">
                                                <!-- Decorative elements -->
                                                <div class="absolute -bottom-4 -right-4 w-20 h-20 rounded-full bg-white/10 backdrop-blur-sm"></div>
                                                <div class="absolute -top-4 -left-4 w-16 h-16 rounded-full bg-white/10 backdrop-blur-sm"></div>
                                                
                                                <div class="text-center z-10">
                                                    <h3 class="text-lg font-medium text-[#5A5A5A] group-hover:text-[#3D3D3D] transition-colors {{ $isActive ? 'font-semibold text-[#3D3D3D]' : '' }}">
                                                        {{ $categoryName }}
                                                    </h3>
                                                    @if($hasSubcategories)
                                                        <div class="mt-2 flex justify-center gap-2">
                                                            <button @click.prevent.stop="open = !open" 
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/80 text-[#886666] backdrop-blur-sm hover:bg-[#f8e8e8] {{ $isActive ? 'bg-white/90 text-[#6D5A5A]' : '' }}">
                                                                +{{ count($subcategories[$categoryKey] ?? []) }} options
                                                                <svg xmlns="http://www.w3.org/2000/svg" 
                                                                    class="ml-1 h-3 w-3 text-[#886666] transform transition-transform duration-200"
                                                                    :class="{ 'rotate-180': open }"
                                                                    viewBox="0 0 20 20" 
                                                                    fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Subcategories Panel -->
                            @if($hasSubcategories && isset($subcategories[$categoryKey]) && count($subcategories[$categoryKey]) > 0)
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 translate-y-1"
                                     class="absolute z-50 w-full mt-2">
                                    <div class="bg-white rounded-xl shadow-[0_8px_24px_rgba(0,0,0,0.08)] border border-[#EAEAEA] overflow-hidden backdrop-blur-sm">
                                        <div class="p-4">
                                            <h4 class="text-xs font-medium uppercase tracking-wider text-[#AAAAAA] mb-2 flex items-center">
                                                <span>Browse {{ $categoryName }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </h4>
                                            <div class="grid grid-cols-2 gap-2">
                                                @foreach($subcategories[$categoryKey] as $subKey => $subName)
                                                    @php
                                                        $isSubActive = $subcategory === $subKey;
                                                    @endphp
                                                    <a href="{{ route($subRouteName, ['gender' => $currentGender, 'category' => $categoryKey, 'subcategory' => $subKey]) }}" 
                                                       class="px-3 py-2 text-sm rounded-lg transition-all duration-200 flex items-center
                                                              {{ $isSubActive ? 
                                                                 'bg-[#F9E8E8] text-[#8A5A5A] font-medium border border-[#E8B6B6]/50 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]' : 
                                                                 'text-[#7A7A7A] hover:bg-[#FAF5F5] hover:text-[#6D5A5A]' }}">
                                                        @if($categoryKey === Product::CATEGORY_BRANDS)
                                                            <span class="inline-block w-6 h-6 rounded-full bg-[#F0E8E8] mr-2 flex-shrink-0 border border-[#E8D6D6]"></span>
                                                        @endif
                                                        {{ $subName }}
                                                        @if($isSubActive)
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 text-[#8A5A5A]" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
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
                                    class="product-image main-image">
                                @if($product->imageToSwitch)
                                <img src="{{ asset('storage/' . $product->imageToSwitch) }}" 
                                    alt="{{ $product->name }} - Alternative View"
                                    class="product-image hover-image">
                                @endif
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
            background-color: #FFF5F5;
            border-radius: 1rem;
            padding: 1.25rem;
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
            position: absolute;
            top: 0;
            left: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .main-image {
            opacity: 1;
            z-index: 1;
        }

        .hover-image {
            opacity: 0;
            z-index: 2;
        }

        .product-card:hover .product-image-container .main-image {
            opacity: 0;
        }

        .product-card:hover .product-image-container .hover-image {
            opacity: 1;
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.1), transparent);
            pointer-events: none;
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
            gap: 0.875rem;
            margin-top: 1rem;
        }

        .detail-item {
            display: flex !important;
            align-items: center;
            background-color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            margin-bottom: 0.5rem;
            opacity: 1 !important;
        }

        .flip-card-back .detail-item {
            background-color: #FFF5F5;
            border: 1px solid rgba(136, 102, 102, 0.1);
        }

        .detail-text {
            color: #886666;
            font-size: 0.9rem;
            margin: 0;
        }

        .detail-icon {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon {
            width: 100%;
            height: 100%;
        }

        .detail-text {
            font-size: 0.875rem;
            color: #4A4A4A;
            line-height: 1.4;
        }

        .brand-detail {
            background-color: #FFF5F5;
            border: 1px solid rgba(136, 102, 102, 0.1);
            margin-bottom: 0.75rem;
            display: flex !important;
            opacity: 1 !important;
        }

        .brand-text {
            font-weight: 500;
            color: #886666;
        }

        .flip-card-back .detail-item {
            display: flex !important;
            opacity: 1 !important;
        }

        .product-actions {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(136, 102, 102, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        /* Button Styles */
        .details-button, .back-button, 
        .add-to-cart-button, .login-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            font-weight: 500;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            background-color: white;
            color: #886666;
            border: 1px solid rgba(136, 102, 102, 0.2);
        }

        .details-button:hover, .back-button:hover,
        .add-to-cart-button:hover, .login-button:hover {
            background-color: #F8E8E8;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(136, 102, 102, 0.1);
        }

        .add-to-cart-button, .login-button {
            background-color: #F8E8E8;
            color: #886666;
            border: none;
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
        /* Smooth transitions for all interactive elements */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Refined shadow effects */
    .shadow-soft {
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
    }
    
            /* Mobile-specific styles */
        @media (max-width: 768px) {
            .subcategories-panel {
                max-height: 60vh;
                overflow-y: auto;
            }

            .detail-item {
                padding: 0.75rem;
                margin-bottom: 0.5rem;
            }
        }

        /* Custom scrollbar for subcategory panels */
        .subcategory-panel::-webkit-scrollbar {
            width: 4px;
        }
        .subcategory-panel::-webkit-scrollbar-thumb {
            background-color: #F5D7D7;
            border-radius: 2px;
        }

        /* Active state indicator for mobile */
        .category-indicator {
            transition: transform 0.2s ease;
        }
        
        .category-active .category-indicator {
            transform: rotate(180deg);
        }
    </style>

    <script>
        function flipCard(button) {
            const card = button.closest('.product-card');
            if (!card) return;
            
            // Close any other flipped cards first
            document.querySelectorAll('.product-card.flipped').forEach(flippedCard => {
                if (flippedCard !== card) {
                    flippedCard.classList.remove('flipped');
                }
            });
            
            // Ensure content is visible before flipping
            const detailItems = card.querySelectorAll('.detail-item');
            detailItems.forEach(item => {
                item.style.display = 'flex';
            });
            
            // Then flip the clicked card
            setTimeout(() => {
                card.classList.toggle('flipped');
            }, 50);
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
                // Add new content directly to container
                container.insertAdjacentHTML('beforeend', data.html);

                // Update the button
                if (data.hasMore) {
                    button.dataset.page = parseInt(page) + 1;
                } else {
                    button.style.display = 'none';
                }

                // Initialize any necessary functionality for new cards
                initializeNewCards();
            });
        }

        function initializeCardButtons(card) {
            // Initialize flip buttons
            const flipButtons = card.querySelectorAll('button[onclick*="flipCard"]');
            flipButtons.forEach(button => {
                button.onclick = function(e) {
                    e.preventDefault();
                    flipCard(this);
                };
            });

            // Initialize add to cart button
            const addToCartButton = card.querySelector('button[onclick*="addToCart"]');
            if (addToCartButton) {
                const originalOnClick = addToCartButton.getAttribute('onclick');
                const matches = originalOnClick.match(/addToCart\('([^']*)', '([^']*)', ([^,]*), '([^']*)'\)/);
                if (matches) {
                    const [_, id, name, price, image] = matches;
                    addToCartButton.onclick = function(e) {
                        e.preventDefault();
                        addToCart(id, name, parseFloat(price), image);
                    };
                }
            }
        }

        function initializeNewCards() {
            const newCards = document.querySelectorAll('.product-card:not(.initialized)');
            newCards.forEach(card => {
                // Initialize buttons
                initializeCardButtons(card);
                
                // Remove hover effect handling from JavaScript
                // We'll handle it purely with CSS

                card.classList.add('initialized');
            });
        }

        // Initialize cart as soon as possible
        initializeCart();

        // Initialize other components when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            initializeNewCards();
            
            // Remove the click event listeners for categories since we're handling it with direct links now
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.addedNodes.length) {
                        mutation.addedNodes.forEach((node) => {
                            if (node.nodeType === 1 && node.classList.contains('product-card')) {
                                if (!node.classList.contains('initialized')) {
                                    initializeNewCards();
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

        function initializeCart() {
            let userId = "{{ auth()->id() ?? 'guest' }}";
            let cartKey = `cart_${userId}`;
            
            try {
                // Get existing cart or initialize new one
                let currentCart = localStorage.getItem(cartKey);
                
                if (!currentCart) {
                    // If no cart exists, check for existing cart in other keys
                    let existingCart = null;
                    
                    // First check if there's a cart for this specific user
                    if (userId !== 'guest') {
                        existingCart = localStorage.getItem(`cart_${userId}`);
                    }
                    
                    // If no existing cart found, initialize empty cart
                    if (!existingCart) {
                        existingCart = JSON.stringify({});
                    }
                    
                    // Set the cart
                    localStorage.setItem(cartKey, existingCart);
                }
                
                // Update cart count
                updateCartCount();
                
            } catch (error) {
                console.error('Error initializing cart:', error);
                // Fallback to empty cart in case of error
                localStorage.setItem(cartKey, JSON.stringify({}));
            }
        }
        
        // Function to get current cart data
        function getCurrentCart() {
            const userId = "{{ auth()->id() ?? 'guest' }}";
            const cartKey = `cart_${userId}`;
            return JSON.parse(localStorage.getItem(cartKey) || '{}');
        }

        function updateCartCount() {
            try {
                const cart = getCurrentCart();
                let totalItems = 0;
                
                for (let productId in cart) {
                    if (cart[productId] && cart[productId].quantity) {
                        totalItems += cart[productId].quantity;
                    }
                }
                
                const cartCountElement = document.getElementById('cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = totalItems;
                }

                // Dispatch event for other pages that might need to update
                window.dispatchEvent(new CustomEvent('cartUpdated', { 
                    detail: { count: totalItems }
                }));
            } catch (error) {
                console.error('Error updating cart count:', error);
            }
        }

        // Listen for cart updates from other pages
        window.addEventListener('cartUpdated', function(event) {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = event.detail.count;
            }
        });

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
    <style>
        .brand-detail {
            background-color: #FFF5F5;
            border: 1px solid rgba(136, 102, 102, 0.1);
            margin-bottom: 0.75rem;
            display: flex !important;
            opacity: 1 !important;
        }

        .brand-text {
            font-weight: 500;
            color: #886666;
        }

        .flip-card-back .detail-item {
            display: flex !important;
            opacity: 1 !important;
        }
    </style>
</x-app-layout> 