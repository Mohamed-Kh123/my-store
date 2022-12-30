<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'cookie_id', 'product_id', 'user_id', 'quantity', 'id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $with = [
        'product',
    ];

    protected static function booted()
    {
        static::creating(function(Cart $cart){
            $cart->id = Str::uuid();
        });
    }
}
