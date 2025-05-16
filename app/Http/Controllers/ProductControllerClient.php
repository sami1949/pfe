<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductControllerClient extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        // Get products based on category filter
        $query = Product::query();
        
        if ($category) {
            $query->where('category', $category);
        }

        $allProducts = $query->get();

        // Shuffle and get 3 random products
        $randomProducts = $allProducts->shuffle()->take(3);
        
        // Get remaining products (excluding the 3 random ones)
        $remainingProducts = $allProducts->diff($randomProducts)->shuffle();

        return view('client.products.index', [
            'randomProducts' => $randomProducts,
            'remainingProducts' => $remainingProducts,
            'category' => $category
        ]);
    }

    public function publicIndex()
{
    return $this->handleProductsView(null, false);
}

public function publicCategory($category)
{
    return $this->handleProductsView($category, false);
}

public function privateIndex()
{
    return $this->handleProductsView(null, true);
}

public function privateCategory($category)
{
    return $this->handleProductsView($category, true);
}

private function handleProductsView($category, $isPrivate)
{
    $products = Product::query();
    
    if ($category) {
        $products = $products->where('category', $category);
    }
    
    $products = $products->paginate(12);
    
    return view('products.index', [
        'products' => $products,
        'category' => $category,
        'isPrivate' => $isPrivate
    ]);
}
}