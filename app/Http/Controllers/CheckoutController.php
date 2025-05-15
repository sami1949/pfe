<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();
        $cartKey = 'cart_'.$user->id;
        $cartItems = json_decode($request->cookie($cartKey), true) ?? [];
        
        // Validate cart isn't empty
        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }
        
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|in:credit_card,paypal',
        ]);
        
        // Here you would typically:
        // 1. Create an order record in database
        // 2. Process payment through a payment gateway
        // 3. Clear the cart
        // 4. Send confirmation email
        
        // For now, we'll just simulate success
        return redirect()->route('checkout.success')->with([
            'order_id' => 'ORD-'.strtoupper(uniqid()),
            'amount' => array_reduce($cartItems, function($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0)
        ]);
    }
}