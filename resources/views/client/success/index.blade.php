<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4">
            <h2 class="font-bold text-2xl md:text-3xl text-gray-800">
                {{ __('Order Confirmation') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden text-center py-12 px-6">
                <div class="mx-auto w-24 h-24 bg-teal-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Thank you for your order!</h3>
                <p class="text-gray-600 mb-6">Your order #{{ session('order_id') }} has been placed successfully.</p>
                
                <div class="max-w-xs mx-auto bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Total Paid:</span>
                        <span class="font-medium">€{{ number_format(session('amount'), 2) }}</span>
                    </div>
                    <div class="text-sm text-gray-500">A confirmation email has been sent to your address.</div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('product.private') }}" class="inline-block bg-white border border-teal-600 text-teal-600 hover:bg-teal-50 font-medium py-3 px-6 rounded-lg transition-all">
                        Continue Shopping
                    </a>
                    <a href="{{ route('orders.show', session('order_id')) }}" class="inline-block bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 px-6 rounded-lg transition-all shadow-md hover:shadow-lg">
                        View Order
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>