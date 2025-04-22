<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Produit 1',
            'description' => 'Description détaillée du produit 1',
            'price' => 99.99,
            'image' => 'products/product1.jpg'
        ]);

        Product::create([
            'name' => 'Produit 2',
            'description' => 'Description du produit 2',
            'price' => 149.99,
            'image' => 'products/product2.jpg'
        ]);
    }
}