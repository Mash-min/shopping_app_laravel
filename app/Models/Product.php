<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'stock',
        'shipping_fee',
        'discount',
        'slug',
        'status',
        'refund',
        'warranty'
    ];
    
    protected $attributes = [
        'refund' => 3,
        'warranty' => false,
        'status' => 'active'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($product) {
            $product->slug = 'product-'.rand().$product->id.time();
        });
    }

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function tags()
    {
        return $this->hasMany(ProductTag::class, 'product_id');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'product_id');
    }

}
