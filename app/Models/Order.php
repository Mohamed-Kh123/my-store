<?php

namespace App\Models;

use App\Observers\OrderCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::observe(OrderCreated::class);       
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                ->using(OrderItem::class)
                ->as('items')
                ->withPivot(['quantity', 'price']);
            
    }
    public function payment()
    {
        return $this->hasMany(Payment::class , 'order_id');
    }
}
