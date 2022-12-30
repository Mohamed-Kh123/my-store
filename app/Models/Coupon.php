<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;


    public function couponUser()
    {
        return $this->hasMany(CouponUser::class, 'coupon_id', 'id');
    }

    public function discount($total)
    {
        if($this->type == 'percent'){
            return ($this->amount / 100) * $total;
        }
        if($this->type == 'fixed'){
            return $this->amount;
        }

        return 0;
    }
}
