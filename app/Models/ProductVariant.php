<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_variant_sku',
        'product_variant_quantity',
        'product_variant_price',
        'product_variant_price_sale',
        'product_variant_image',
    ];
}
