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