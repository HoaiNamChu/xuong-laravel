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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->constrained();
            $table->string('product_variant_sku')->nullable();
            $table->unsignedInteger('product_variant_quantity')->default(0);
            $table->double('product_variant_price')->default(0);
            $table->double('product_variant_price_sale')->nullable();
            $table->string('product_variant_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
