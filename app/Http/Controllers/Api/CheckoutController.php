<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Cart\CartRepository;
use App\Trait\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckoutController extends Controller
{

    use HttpResponses;
    
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orWhere('cookie_id', $this->getCookieId('orders'))->get();

        return OrderResource::collection($orders);
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
                'user_id' => $this->getUserId(), // in controller class
                'cookie_id' => $this->getCookieId('orders'), // in controller class
                'total' => $this->cart->total(),
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
             

            return new OrderResource($order);

        }catch(Throwable $e){
            DB::rollBack();
            throw $e;
        }

    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return $this->success('', "Order deleted!");
    }
}
