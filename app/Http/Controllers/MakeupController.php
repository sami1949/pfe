<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MakeupController extends Controller
{
    public function index(Request $request)
    {
        $subcategory = $request->query('subcategory');

        $query = Product::where('category', 'maquillage');

        if ($subcategory) {
            $query->where('subcategory', $subcategory);
        }

        $products = $query->get();

        return view('client.products.makeup.index', [
            'products' => $products,
            'subcategory' => $subcategory,
        ]);
    }
} 