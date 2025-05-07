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
            'category' => 'femme',
            'quantity' => '100',
            'description' => 'Description détaillée du produit 1',
            'price' => 99.99,
            'image' => 'products/product1.jpg'
        ]);

        Product::create([
            'name' => 'Produit 2',
            'category' => 'femme',
            'quantity' => '150',
            'description' => 'Description détaillée du produit 2',
            'price' => 199.99,
            'image' => 'products/product2.jpg'
        ]);


        Product::create([
            'name' => 'Crème Hydratante Luxe',
            'category' => 'femme',
            'quantity' => '150',
            'description' => 'Crème hydratante intense pour une peau de femme éclatante',
            'price' => 59.99,
            'image' => 'products/creme-hydratante.jpg'
        ]);

        Product::create([
            'name' => 'Sérum Anti-Âge',
            'category' => 'femme',
            'quantity' => '150',
            'description' => 'Sérum révolutionnaire pour réduire les signes de l\'âge',
            'price' => 79.99,
            'image' => 'products/serum-anti-age.jpg'
        ]);

        Product::create([
            'name' => 'Gel Nettoyant Homme',
            'category' => 'homme',
            'quantity' => '150',
            'description' => 'Gel nettoyant spécialement formulé pour la peau masculine',
            'price' => 39.99,
            'image' => 'products/gel-nettoyant.jpg'
        ]);
        
    }
}