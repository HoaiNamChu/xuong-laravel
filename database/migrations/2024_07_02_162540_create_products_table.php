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
            $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->string('product_name');
            $table->string('product_slug')->unique();
            $table->string('product_sku')->unique();
            $table->string('product_image')->nullable();
            $table->double('product_price')->default(0);
            $table->double('product_price_sale')->nullable();
            $table->unsignedInteger('product_quantity')->default(0);
            $table->string('product_description')->nullable();
            $table->text('product_content')->nullable();
            $table->string('product_material')->nullable()->comment('Chất liệu');
            $table->text('product_user_manual')->nullable()->comment('Hướng dẫn sử dụng');
            $table->unsignedBigInteger('product_views')->default(0);
            $table->boolean('product_is_active')->default(true);
            $table->boolean('product_is_hot_deal')->default(false);
            $table->boolean('product_is_good_deal')->default(false);
            $table->boolean('product_is_new')->default(false);
            $table->boolean('product_is_show_home')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
