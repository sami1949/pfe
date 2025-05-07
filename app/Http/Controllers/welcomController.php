<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class welcomController extends Controller
{
    public function index (Request $request) {
        $category = $request->query('category');

        if ($category) {
            $products = Product::where('category', $category)->get();
        } else {
            $products = Product::all();
        }
    
        return view('welcome', compact('products'));
    }
}
