<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_dimension', 'dimension_id', 'product_id', 'id', 'id');
    }
}
