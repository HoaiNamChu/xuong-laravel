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
        Schema::create('variant_attibute_value', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ProductVariant::class)->constrained();
            $table->foreignIdFor(\App\Models\ProductAttributeValue::class)->constrained();

            $table->primary(['product_variant_id', 'product_attribute_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_attibute_value');
    }
};
