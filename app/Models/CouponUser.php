<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CouponUser extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "coupon_user";

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
