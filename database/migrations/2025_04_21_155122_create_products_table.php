<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender')->default('femme');
            $table->enum('category', [
                'nouveau',
                'se_maquiller',
                'skin_care',
                'soin_du_corps',
                'soin_des_cheveux',
                'fragrance',
                'vente',
                'brands'
            ]);
            $table->enum('subcategory', [
                'face',
                'lips',
                'eyes',
                'makeup_tool',
                'all_fragrance',
                'perfumes',
                'mists',
                'sets'
            ])->nullable();
            $table->string('brand');
            $table->string('quantity');
            $table->string('description');
            $table->string('description1');
            $table->string('description2');
            $table->string('description3');
            $table->decimal('price',8,2);
            $table->string('image')->nullable();
            $table->string('imageToSwitch')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
