<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Jobs\CancelOrderJob;
use App\Jobs\SendEmailToUserToPayOrder;
use App\Models\Cart;
use App\Models\Coupon;
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
    
        return view('front.checkout',[
            'coupon' => $coupon,
            'discount' => $coupon['discount'] ?? 0,
            'cart' => $this->cart,
            'user' => Auth::user(),
            'order' => new Order(),
            'countries' => Countries::getNames(),
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
        ]);

        DB::beginTransaction();

        

        try{
            $coupon = Session::get('coupon');
            $newTotal = $this->cart->total() - ($coupon['discount'] ?? 0);
            

            $order = Order::create([
                'billing_name' => $request->billing_name,
                'billing_phone_number' => $request->billing_phone_number,
                'billing_address' => $request->billing_address,
                'billing_email' => $request->billing_email,
                'billing_city' => $request->billing_city,
                'billing_country_name' => $request->billing_country_name,
                'billing_postcode' => $request->billing_postcode,
                'billing_state' => $request->billing_state,
                'shipping_name' => $request->shipping_name,
                'shipping_phone_number' => $request->shipping_phone_number,
                'shipping_address' => $request->shipping_address,
                'shipping_email' => $request->shipping_email,
                'shipping_city' => $request->shipping_city,
                'shipping_country_name' => $request->shipping_country_name,
                'shipping_postcode' => $request->shipping_postcode,
                'shipping_state' => $request->shipping_state,
                'user_id' => Auth::id() ?? null,
                'cookie_id' => $this->getCookieId('orders'),
                'total' => $newTotal,
            ]);

            $items = [];
            foreach($this->cart->all() as $item){
                $items[]= [
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' =>  $item->product->price,
                ];
                
            }
            DB::table('order_items')->insert($items);
            DB::commit();

            event(new OrderCreated($order));
             

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
