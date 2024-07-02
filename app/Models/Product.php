<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_name',
        'product_slug',
        'product_sku',
        'product_image',
        'product_price',
        'product_price_sale',
        'product_description',
        'product_content',
        'product_material',
        'product_user_manual',
        'product_views',
        'product_is_active',
        'product_is_hot_deal',
        'product_is_good_deal',
        'product_is_new',
        'product_is_show_home',
    ];

    protected $casts = [
        'product_is_active'=> 'boolean',
        'product_is_hot_deal'=> 'boolean',
        'product_is_good_deal'=> 'boolean',
        'product_is_new'=> 'boolean',
        'product_is_show_home'=> 'boolean',
    ];
}
