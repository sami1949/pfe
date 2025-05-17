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