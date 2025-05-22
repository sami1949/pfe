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
            'description1' => 'Formule innovante pour un résultat immédiat',
            'description2' => 'Texture légère et confortable',
            'description3' => 'Convient à tous les types de peau',
            'price' => 39.99,
            'image' => 'products/nouveau.jpg',
            'imageToSwitch' => 'products/nouveau-alt.jpg'
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
            'description1' => 'Réduit visiblement l\'apparence des pores',
            'description2' => 'Tenue longue durée jusqu\'à 12 heures',
            'description3' => 'Texture silicone-free',
            'price' => 29.99,
            'image' => 'products/primer1.jpg',
            'imageToSwitch' => 'products/primer.jpg'
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
            'description1' => 'Formule ultra-pigmentée',
            'description2' => 'Ne dessèche pas les lèvres',
            'description3' => 'Disponible en 12 teintes tendance',
            'price' => 19.99,
            'image' => 'products/lipstick1.jpg',
            'imageToSwitch' => 'products/lipstick.jpg'
        ]);

        // Updated: Changed from null to BRAND_ELF (or BRAND_NYX if preferred)
        Product::create([
            'name' => 'produit Homme',
            'gender' => 'homme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_PERFUMES,
            'brand' => Product::BRAND_ELF, // Assigned ELF (change to NYX if needed)
            'quantity' => '100',
            'description' => 'RI7A NADIA',
            'description1' => 'Parfum oriental boisé',
            'description2' => 'Notes de tête: Bergamote, Cardamome',
            'description3' => 'Tenue exceptionnelle de 8 heures',
            'price' => 190.99,
            'image' => 'products/RI7A.jpg',
            'imageToSwitch' => 'products/RI7A-alt.jpg'
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
            'description1' => 'Pigmentation intense',
            'description2' => 'Formule facile à estomper',
            'description3' => 'Inclut pinceau double face',
            'price' => 39.99,
            'image' => 'products/eyeshadow.jpg',
            'imageToSwitch' => 'products/eyeshadow-alt.jpg'
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
            'description1' => 'Poils synthétiques de haute qualité',
            'description2' => 'Manches ergonomiques',
            'description3' => 'Nettoyage facile',
            'price' => 49.99,
            'image' => 'products/brushes.jpg',
            'imageToSwitch' => 'products/brushes-alt.jpg'
        ]);

        // Skin Care (Updated: Changed from null to BRAND_ELF)
        Product::create([
            'name' => 'Crème Hydratante Luxe',
            'gender' => 'femme',
            'category' => Product::CATEGORY_SKINCARE,
            'subcategory' => null,
            'brand' => Product::BRAND_ELF,
            'quantity' => '150',
            'description' => 'Crème hydratante intense pour une peau éclatante',
            'description1' => 'Enrichie en acide hyaluronique',
            'description2' => 'Texture non grasse',
            'description3' => 'Testé dermatologiquement',
            'price' => 59.99,
            'image' => 'products/creme-hydratante.jpg',
            'imageToSwitch' => 'products/creme-hydratante-alt.jpg'
        ]);

        // Soin du Corps (Updated: Changed from null to BRAND_ELF)
        Product::create([
            'name' => 'Crème Corps Nourrissante',
            'gender' => 'femme',
            'category' => Product::CATEGORY_CORPS,
            'subcategory' => null,
            'brand' => Product::BRAND_ELF,
            'quantity' => '200',
            'description' => 'Crème corps ultra-nourrissante',
            'description1' => 'A base de beurre de karité',
            'description2' => 'Absorption rapide',
            'description3' => 'Parfum délicat',
            'price' => 34.99,
            'image' => 'products/body-cream.jpg',
            'imageToSwitch' => 'products/body-cream-alt.jpg'
        ]);

        // Soin des Cheveux (Updated: Changed from null to BRAND_ELF)
        Product::create([
            'name' => 'Masque Capillaire Réparateur',
            'gender' => 'femme',
            'category' => Product::CATEGORY_CHEVEUX,
            'subcategory' => null,
            'brand' => Product::BRAND_ELF,
            'quantity' => '250',
            'description' => 'Masque réparateur intense pour cheveux',
            'description1' => 'Enrichi en protéines de soie',
            'description2' => 'Résultats visibles dès la première application',
            'description3' => 'Convient aux cheveux colorés',
            'price' => 29.99,
            'image' => 'products/hair-mask.jpg',
            'imageToSwitch' => 'products/hair-mask-alt.jpg'
        ]);

        // Fragrance - All Fragrance (Updated: Changed from null to BRAND_NYX)
        Product::create([
            'name' => 'Eau de Parfum Florale',
            'gender' => 'femme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_ALL_FRAGRANCE,
            'brand' => Product::BRAND_NYX,
            'quantity' => '75',
            'description' => 'Collection complète de parfums floraux',
            'description1' => 'Notes de tête: Pêche, Bergamote',
            'description2' => 'Notes de cœur: Rose, Jasmin',
            'description3' => 'Notes de fond: Musc, Vanille',
            'price' => 89.99,
            'image' => 'products/perfume-all.jpg',
            'imageToSwitch' => 'products/perfume-all-alt.jpg'
        ]);

        // Fragrance - Perfumes (Updated: Changed from null to BRAND_NYX)
        Product::create([
            'name' => 'Parfum Élégance',
            'gender' => 'femme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_PERFUMES,
            'brand' => Product::BRAND_NYX,
            'quantity' => '50',
            'description' => 'Parfum de luxe aux notes délicates',
            'description1' => 'Concentration exceptionnelle',
            'description2' => 'Flacon soufflé à la main',
            'description3' => 'Tenue 24 heures',
            'price' => 129.99,
            'image' => 'products/perfume.jpg',
            'imageToSwitch' => 'products/perfume-alt.jpg'
        ]);

        // Fragrance - Mists (Updated: Changed from null to BRAND_NYX)
        Product::create([
            'name' => 'Brume Parfumée',
            'gender' => 'femme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_MISTS,
            'brand' => Product::BRAND_NYX,
            'quantity' => '100',
            'description' => 'Brume légère et rafraîchissante',
            'description1' => 'Parfait pour une utilisation quotidienne',
            'description2' => 'Texture ultra-légère',
            'description3' => 'Sans alcool',
            'price' => 34.99,
            'image' => 'products/mist.jpg',
            'imageToSwitch' => 'products/mist-alt.jpg'
        ]);

        // Fragrance - Sets (Updated: Changed from null to BRAND_NYX)
        Product::create([
            'name' => 'Coffret Parfum Deluxe',
            'gender' => 'femme',
            'category' => Product::CATEGORY_FRAGRANCE,
            'subcategory' => Product::SUBCATEGORY_SETS,
            'brand' => Product::BRAND_NYX,
            'quantity' => '25',
            'description' => 'Coffret comprenant parfum, lotion et brume parfumée',
            'description1' => 'Idéal pour offrir',
            'description2' => 'Emballage cadeau luxueux',
            'description3' => 'Valeur exceptionnelle',
            'price' => 149.99,
            'image' => 'products/fragrance-set.jpg',
            'imageToSwitch' => 'products/fragrance-set-alt.jpg'
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
            'description1' => 'Teintes exclusives',
            'description2' => 'Édition collector',
            'description3' => 'Quantités limitées',
            'price' => 24.99,
            'image' => 'products/sale-palette.jpg',
            'imageToSwitch' => 'products/sale-palette-alt.jpg'
        ]);
    }
}