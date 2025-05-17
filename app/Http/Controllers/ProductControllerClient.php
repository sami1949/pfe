<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductControllerClient extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender', Product::GENDER_FEMME);
        $category = $request->query('category');
        $page = $request->query('page', 1);
        $perPage = 6;

        // Get products based on gender and category filter
        $query = Product::query();
        
        if ($gender) {
            $query->where('gender', $gender);
        }
        
        if ($category) {
            $query->where('category', $category);
        }

        // Get total count for pagination
        $total = $query->count();

        // Get paginated products
        $products = $query->skip(($page - 1) * $perPage)
                         ->take($perPage)
                         ->get();

        // Get available categories based on gender
        $categories = Product::getCategoriesByGender($gender);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('client.products.partials.product-cards', ['products' => $products])->render(),
                'hasMore' => ($page * $perPage) < $total
            ]);
        }

        return view('client.products.index', [
            'products' => $products,
            'category' => $category,
            'currentGender' => $gender,
            'categories' => $categories,
            'hasMore' => ($page * $perPage) < $total,
            'currentPage' => $page
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
        $gender = request()->query('gender', Product::GENDER_FEMME);
        $products = Product::query();
        
        if ($gender) {
            $products->where('gender', $gender);
        }
        
        if ($category) {
            $products->where('category', $category);
        }
        
        $products = $products->paginate(12);
        $categories = Product::getCategoriesByGender($gender);
        
        return view('products.index', [
            'products' => $products,
            'category' => $category,
            'isPrivate' => $isPrivate,
            'currentGender' => $gender,
            'categories' => $categories
        ]);
    }
}