<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * @var \App\Repositories\Cart\CartRepository
     */
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        
        $coupon = Session::get('coupon');
        return view('front.cart', [
            'coupon' => $coupon,
            'discount' => $coupon['discount'] ?? 0,
            'cart' => $this->cart,
        ]);
    }

    public function store(Request $request)
    {
        $validateor = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['int', 'min:1', function($attr, $value, $fail) {
                $id = request()->input('product_id');
                $product = Product::find($id);
                if ($value > $product->quantity) {
                    $fail(__('Quantity greater than quantity in stock.'));
                }
            },]
        ]);
        

        
        
        if($request->expectsJson()){
            $cart = $this->cart->add($request->post('product_id'), $request->post('quantity', 1));
    
            return Response::json([
                'message' => __('Item added to cart!'),
                'status' => 1,
                'quantity' => $this->cart->quantity(),
                'total' => $this->cart->total(),
                'carts' => $this->cart->all(),
            ], 201);
        }

        return redirect()->route('cart')->with('success', 'Item added to cart!');
        
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['int', 'required'],
        ]);

        $cart = $this->cart->update($id,  $request->post('quantity'));

        if($request->expectsJson()){
            return response()->json([
                'total' => $this->cart->total(),
                'quantity' => $this->cart->quantity(),
                'subTotal' => $this->cart->subTotal(),
            ]);
        }

        return redirect()->back();

    }
    public function delete($id)
    {
        
        Cart::destroy($id);

        return Response::json([
            'quantity' => $this->cart->quantity(),
            'total' => $this->cart->total(),
            'carts' => $this->cart->all(),
            'subTotal' => $this->cart->subTotal(),
        ], 200);

    }

}
