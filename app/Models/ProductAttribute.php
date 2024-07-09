<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_attribute_name',
    ];

    public function productAttributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
