<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    
    // Define constants for genders
    const GENDER_FEMME = 'femme';
    const GENDER_HOMME = 'homme';
    
    // Define constants for categories
    const CATEGORY_NOUVEAU = 'nouveau';
    const CATEGORY_MAQUILLAGE = 'se_maquiller';
    const CATEGORY_SKINCARE = 'skin_care';
    const CATEGORY_CORPS = 'soin_du_corps';
    const CATEGORY_CHEVEUX = 'soin_des_cheveux';
    const CATEGORY_FRAGRANCE = 'fragrance';
    const CATEGORY_VENTE = 'vente';
    const CATEGORY_BRANDS = 'brands';

    // Define constants for subcategories
    const SUBCATEGORY_FACE = 'face';
    const SUBCATEGORY_LIPS = 'lips';
    const SUBCATEGORY_EYES = 'eyes';
    const SUBCATEGORY_MAKEUP_TOOL = 'makeup_tool';
    
    // Fragrance subcategories
    const SUBCATEGORY_ALL_FRAGRANCE = 'all_fragrance';
    const SUBCATEGORY_PERFUMES = 'perfumes';
    const SUBCATEGORY_MISTS = 'mists';
    const SUBCATEGORY_SETS = 'sets';

    // Brands
    const BRAND_ELF = 'e.l.f Cosmetics';
    const BRAND_NYX = 'NYX Professional Makeup';
    
    protected $fillable = [
        'name',
        'gender',
        'category',
        'subcategory',
        'brand',
        'quantity',
        'description',
        'description1',
        'description2',
        'description3',
        'price',
        'image',
        'imageToSwitch'
    ];

    // Get all available genders
    public static function getGenders()
    {
        return [
            self::GENDER_FEMME => 'Femme',
            self::GENDER_HOMME => 'Homme'
        ];
    }

    // Get all categories
    public static function getCategories()
    {
        return [
            self::CATEGORY_NOUVEAU => 'Nouveau',
            self::CATEGORY_MAQUILLAGE => 'Se maquiller',
            self::CATEGORY_SKINCARE => 'Skin Care',
            self::CATEGORY_CORPS => 'Soin du corps',
            self::CATEGORY_CHEVEUX => 'Soin des cheveux',
            self::CATEGORY_FRAGRANCE => 'Fragrance',
            self::CATEGORY_VENTE => 'VENTE',
            self::CATEGORY_BRANDS => 'Brands'
        ];
    }

    // Get categories by gender
    public static function getCategoriesByGender($gender)
    {
        return self::getCategories(); // Same categories for both genders in this case
    }

    // Get all subcategories
    public static function getSubcategories()
    {
        return [
            self::SUBCATEGORY_FACE => 'Face',
            self::SUBCATEGORY_LIPS => 'Lips',
            self::SUBCATEGORY_EYES => 'Eyes',
            self::SUBCATEGORY_MAKEUP_TOOL => 'Makeup Tools',
            self::SUBCATEGORY_ALL_FRAGRANCE => 'All Fragrance',
            self::SUBCATEGORY_PERFUMES => 'Perfumes',
            self::SUBCATEGORY_MISTS => 'Mists',
            self::SUBCATEGORY_SETS => 'Sets'
        ];
    }

    // Get subcategories by category
    public static function getSubcategoriesByCategory($category)
    {
        $subcategories = [
            self::CATEGORY_MAQUILLAGE => [
                self::SUBCATEGORY_FACE => 'Face',
                self::SUBCATEGORY_LIPS => 'Lips',
                self::SUBCATEGORY_EYES => 'Eyes',
                self::SUBCATEGORY_MAKEUP_TOOL => 'Makeup Tools'
            ],
            self::CATEGORY_FRAGRANCE => [
                self::SUBCATEGORY_ALL_FRAGRANCE => 'All Fragrance',
                self::SUBCATEGORY_PERFUMES => 'Perfumes',
                self::SUBCATEGORY_MISTS => 'Mists',
                self::SUBCATEGORY_SETS => 'Sets'
            ],
            self::CATEGORY_BRANDS => [
                self::BRAND_ELF => 'e.l.f Cosmetics',
                self::BRAND_NYX => 'NYX Professional Makeup'
            ]
        ];

        return $subcategories[$category] ?? [];
    }

    // Get all brands
    public static function getBrands()
    {
        return [
            self::BRAND_ELF => 'e.l.f Cosmetics',
            self::BRAND_NYX => 'NYX Professional Makeup'
        ];
    }

    // Relationship with users who favorited this product
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps();
    }

    // Scope for gender filtering
    public function scopeForGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    // Scope for category filtering
    public function scopeForCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope for subcategory filtering
    public function scopeForSubcategory($query, $subcategory)
    {
        return $query->where('subcategory', $subcategory);
    }
}