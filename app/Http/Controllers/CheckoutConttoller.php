<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Jobs\CancelOrderJob;
use App\Jobs\SendEmailToUserToPayOrder;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Cart\CartRepository;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Intl\Locales;
use Illuminate\Support\Str;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutConttoller extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }


    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orWhere('cookie_id', $this->getCookieId('orders'))->get();
        return view('front.orders', [
            'orders' => $orders,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $coupon = Session::get('coupon');
        $delivery = new Delivery();

        return view('front.checkout',[
            'coupon' => $coupon,
            'discount' => $coupon['discount'] ?? 0,
            'cart' => $this->cart,
            'user' => Auth::user(),
            'order' => new Order(),
            'countries' => Countries::getNames(),
            'delivery' => $delivery,
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'billing_name' => 'string|required',
            'billing_phone_number' => 'required',
            'billing_address' => 'required',
            'billing_email' => 'required|email',
            'billing_city' => 'required',
            'billing_country_name' => 'required',
            'billing_postcode' => 'required',
            'billing_state' => 'required',
            'shipping_name' => 'string|nullable',
            'shipping_phone_number' => 'nullable',
            'shipping_address' => 'nullable',
            'shipping_email' => 'nullable|email',
            'shipping_city' => 'nullable',
            'shipping_country_name' => 'nullable',
            'shipping_postcode' => 'nullable',
            'shipping_state' => 'nullable',
            'delivery_name' => 'required',
        ]);

        DB::beginTransaction();

        

        try{
            
            $order = new Order();
            //createOrder is a method in the Order model
            
            $chec = $order->createOrder($this->cart, $request);


            // create delivery for the order
            $delivery = new Delivery();
            $delivery->order_id = $chec->id;
            $delivery->delivery_price = $chec->total + config('app.delivery_price');
            $delivery->name = $request->delivery_name;
            $delivery->save();
            DB::commit();

            event(new OrderCreated($chec));

             

            return redirect()->route('orders', $order->id);
        }catch(Throwable $e){
            DB::rollBack();
            throw $e;
        }
    }
    
    public function delete($id)
    {
        Order::destroy($id);
        
        return response()->json(['message' => 'Order deleted!'], 200);
    }

   
}
