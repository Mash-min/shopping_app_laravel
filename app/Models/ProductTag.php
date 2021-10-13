<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'product_id'
    ];

    protected $hidden = [
        'product_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($product) {
            $product->tag = str_replace(" ", "-", $product->tag);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
