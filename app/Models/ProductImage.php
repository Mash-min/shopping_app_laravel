<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'product_id',
        'slug'
    ];

    protected $hidden = [
        'product_id',
        'id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($productImage) {
            $productImage->slug = 'product-image-'.rand().$productImage->id.time();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
