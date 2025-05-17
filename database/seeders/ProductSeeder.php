<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Nouveau Products
        Product::create([
            'name' => 'Nouveau Produit 2024',
            'gender' => 'femme',
            'category' => Product::CATEGORY_NOUVEAU,
            'subcategory' => null,
            'brand' => Product::BRAND_ELF,
            'quantity' => '50',
            'description' => 'Nouveau produit exclusif',
            'price' => 39.99,
            'image' => 'products/nouveau.jpg'
        ]);

        // Se Maquiller - Face
        Product::create([
            'name' => 'Poreless Putty Primer',
            'gender' => 'femme',
            'category' => Product::CATEGORY_MAQUILLAGE,
            'subcategory' => Product::SUBCATEGORY_FACE,
            'brand' => Product::BRAND_ELF,
            'quantity' => '50',
            'description' => 'Primer lisse et velouté pour un teint parfait',
            'price' => 29.99,
            'image' => 'products/primer.jpg'
        ]);

        // Se Maquiller - Lips
        Product::create([
            'name' => 'Rouge à Lèvres Mat',
            'gender' => 'femme',
            'category' => Product::CATEGORY_MAQUILLAGE,
            'subcategory' => Product::SUBCATEGORY_LIPS,
            'brand' => Product::BRAND_NYX,
            'quantity' => '100',
            'description' => 'Rouge à lèvres mat longue tenue',
            'price' => 19.99,
            'image' => 'products/lipstick.jpg'
        ]);
        Product::create([
            'name' => 'produit Homme',
            'gender' => 'homme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_PERFUMES,
            'brand' => NULL,
            'quantity' => '100',
            'description' => 'RI7A NADIA',
            'price' => 190.99,
            'image' => 'products/RI7A.jpg'
        ]);

        // Se Maquiller - Eyes
        Product::create([
            'name' => 'Palette Fards à Paupières',
            'gender' => 'femme',
            'category' => Product::CATEGORY_MAQUILLAGE,
            'subcategory' => Product::SUBCATEGORY_EYES,
            'brand' => Product::BRAND_ELF,
            'quantity' => '75',
            'description' => 'Palette de 12 teintes mates et shimmer',
            'price' => 39.99,
            'image' => 'products/eyeshadow.jpg'
        ]);

        // Se Maquiller - Makeup Tools
        Product::create([
            'name' => 'Set de Pinceaux Professionnels',
            'gender' => 'femme',
            'category' => Product::CATEGORY_MAQUILLAGE,
            'subcategory' => Product::SUBCATEGORY_MAKEUP_TOOL,
            'brand' => Product::BRAND_NYX,
            'quantity' => '30',
            'description' => 'Set complet de pinceaux de maquillage',
            'price' => 49.99,
            'image' => 'products/brushes.jpg'
        ]);

        // Skin Care
        Product::create([
            'name' => 'Crème Hydratante Luxe',
            'gender' => 'femme',
            'category' => Product::CATEGORY_SKINCARE,
            'subcategory' => null,
            'brand' => null,
            'quantity' => '150',
            'description' => 'Crème hydratante intense pour une peau éclatante',
            'price' => 59.99,
            'image' => 'products/creme-hydratante.jpg'
        ]);

        // Soin du Corps
        Product::create([
            'name' => 'Crème Corps Nourrissante',
            'gender' => 'femme',
            'category' => Product::CATEGORY_CORPS,
            'subcategory' => null,
            'brand' => null,
            'quantity' => '200',
            'description' => 'Crème corps ultra-nourrissante',
            'price' => 34.99,
            'image' => 'products/body-cream.jpg'
        ]);

        // Soin des Cheveux
        Product::create([
            'name' => 'Masque Capillaire Réparateur',
            'gender' => 'femme',
            'category' => Product::CATEGORY_CHEVEUX,
            'subcategory' => null,
            'brand' => null,
            'quantity' => '250',
            'description' => 'Masque réparateur intense pour cheveux',
            'price' => 29.99,
            'image' => 'products/hair-mask.jpg'
        ]);

        // Fragrance - All Fragrance
        Product::create([
            'name' => 'Eau de Parfum Florale',
            'gender' => 'femme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_ALL_FRAGRANCE,
            'brand' => null,
            'quantity' => '75',
            'description' => 'Collection complète de parfums floraux',
            'price' => 89.99,
            'image' => 'products/perfume-all.jpg'
        ]);

        // Fragrance - Perfumes
        Product::create([
            'name' => 'Parfum Élégance',
            'gender' => 'femme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_PERFUMES,
            'brand' => null,
            'quantity' => '50',
            'description' => 'Parfum de luxe aux notes délicates',
            'price' => 129.99,
            'image' => 'products/perfume.jpg'
        ]);

        // Fragrance - Mists
        Product::create([
            'name' => 'Brume Parfumée',
            'gender' => 'femme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_MISTS,
            'brand' => null,
            'quantity' => '100',
            'description' => 'Brume légère et rafraîchissante',
            'price' => 34.99,
            'image' => 'products/mist.jpg'
        ]);

        // Fragrance - Sets
        Product::create([
            'name' => 'Coffret Parfum Deluxe',
            'gender' => 'femme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_SETS,
            'brand' => null,
            'quantity' => '25',
            'description' => 'Coffret comprenant parfum, lotion et brume parfumée',
            'price' => 149.99,
            'image' => 'products/fragrance-set.jpg'
        ]);

        // VENTE
        Product::create([
            'name' => 'Palette Limited Edition',
            'gender' => 'femme',
            'category' => Product::CATEGORY_VENTE,
            'subcategory' => null,
            'brand' => Product::BRAND_NYX,
            'quantity' => '25',
            'description' => 'Palette édition limitée en promotion',
            'price' => 24.99,
            'image' => 'products/sale-palette.jpg'
        ]);
    }
}