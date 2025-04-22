<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nos Produits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
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

            </div>
        </div>
    </div>
</x-app-layout>