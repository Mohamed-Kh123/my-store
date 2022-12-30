<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Order;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class CouponsController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    
    public function store(Request $request)
    {

        $coupon = Coupon::with('couponUser')->where('code', '=', $request->code)->first();
        // dd($coupon->end_date);
        if(!$coupon){
            return redirect()->back()->withErrors('Coupon not found!');
        }
        if($coupon->end_date <= now() || $coupon->start_date >= now()){
            return redirect()->back()->withErrors('Coupon expired!');
        }
        if($coupon->max_use == 5){
            return redirect()->back()->withErrors('Coupon expired!');
        }      

        $coupon->couponUser()->create([
            'user_id' => Auth::id(),
        ]);

        $coupon->max_use = $coupon->max_use + 1;
        $coupon->save();
        
        Session::put('coupon', [
            'discount' => $coupon->discount($this->cart->total()),
            'name' => $coupon->code,
            'id' => $coupon->id,
        ]);

        

        return redirect()->back()->with('success', 'Coupon has been applied!');
    }

    public function removeCoupon($id)
    {
        Session::forget('coupon');
        CouponUser::where('user_id', Auth::id())->where('coupon_id', $id)->delete();
        $coupon = Coupon::where('id', $id)->first();
        $coupon->update([
            'max_use' => DB::raw('max_use - 1'),
        ]);
        $coupon->save();
        return  response()->json([
            'message' => 'Coupon has been removed!',
        ], 200);
    }
}
