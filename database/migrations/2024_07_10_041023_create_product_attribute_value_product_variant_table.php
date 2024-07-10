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
        Schema::create('product_attribute_value_product_variant', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ProductAttributeValue::class)->constrained();
            $table->foreignIdFor(\App\Models\ProductVariant::class)->constrained();

            $table->primary(['product_attribute_value_id', 'product_variant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_value_product_variant');
    }
};
