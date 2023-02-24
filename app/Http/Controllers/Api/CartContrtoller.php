<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use App\Trait\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CartContrtoller extends Controller
{
    use HttpResponses;

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->orWhere('cookie_id', Cookie::get('cart_cookie_id'))->get();
        // $cart = $this->cart->all();
        return CartResource::collection($cart);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $item = $request->post('product_id');
        $qty = $request->post('quantity', 1);

        $cart = Cart::updateOrCreate([
            'cookie_id' => Cookie::get('cart_cookie_id'),
            'product_id' => ($item instanceof Product)? $item->id : $item,
        ], [
            'user_id' => $this->getUserId(),
            'quantity' => DB::raw('quantity + ' . $qty),
        ]);



        return new CartResource($cart);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['int', 'required', 'min:1'],
        ]);

        $cart = Cart::where('id', '=', $id)->first();
        $cart->quantity = $request->post('quantity');
        $cart->save();

        return new CartResource($cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->delete();

        return $this->success("", "Cart deleted!");

    }
}
