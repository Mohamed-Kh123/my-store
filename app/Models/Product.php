<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'image' => 'json'
    ];
    
    protected static function booted()
    {
        static::creating(function(Product $product){
            $product->slug = Str::slug($product->name);
        });
        
        static::updating(function(Product $product){
            $product->slug = Str::slug($product->name);
        });

    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault('No Category');
    } 
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'product_brand', 'product_id', 'brand_id', 'id', 'id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'product_id');
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id', 'id', 'id');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id', 'id', 'id');
    }
    public function dimensions()
    {
        return $this->belongsToMany(Dimension::class, 'product_dimension', 'product_id', 'dimension_id', 'id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id', 'id', 'id');
    }


    public function getImageUrlAttribute()
    {
        if($this->image){
            foreach($this->image as $image){
                return asset('storage/'.$image);
            }
        }
        if($this->image == null){
            return asset('storage/null.jpg');
        } 

    }

    // public function getPriceAttribute()
    // {
    //     if($this->discount){
    //         return ($this->discount  / 100) * $this->price;
    //     }
        
    //     return $this->price;
    // }

  
    public function getLinkAttribute()
    {
        return route('single.product', $this->slug);
    }

    public function getCartLinkAttribute()
    {
        return route('cart.store');
    }

    public function getWishlistLinkAttribute()
    {
        return route('wishlist.store');
    }

   

    
    
    protected $appends = [
        'image_url', 'link', 'cart_link', 'wishlist_link',
        
    ];
}
