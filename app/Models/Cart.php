<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'slug',
        'status'
    ];

    protected $attributes = [
        'quantity' => 1,
        'status' => 'active'
    ];

    protected $hidden = [
        'user_id',
        'product_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($product) {
            $product->slug = 'cart-'.rand().$product->id.time();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    

}
