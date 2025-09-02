<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug', 
        'description',
        'price',
        'product_category_id',
        'image_url',
        'images',
        'colors',
        'attributes',
        'is_active'
    ];

    protected $casts = [
        'attributes' => 'array',
        'images' => 'array',
        'colors' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}