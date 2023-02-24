<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class WishListController extends Controller
{
    public function index()
    {
        $wish_lists = WishList::with('products')->where('cookie_id', $this->getCookieId('wishlist'))->get();

        return view('front.wishlist', [
            'wish_lists' => $wish_lists,
        ]);
    }   
    public function storeWishList(Request $request)
    {
        $wish_list = WishList::where('product_id', $request->input('product_id'))->where('cookie_id', $this->getCookieId('wishlist'))->first();
        if($wish_list){
            $wish_list->user_id = Auth::id();
            $wish_list->save();
            return response()->json(['success' => 'Product already exists in the wish list!']);
        }
        WishList::updateOrCreate([
            'product_id' => $request->input('product_id'),
            'cookie_id' => $this->getCookieId('wishlist'),
        ], [
            'user_id' => Auth::id(),
        ]);

        if($request->expectsJson()){
            $wish_lists = WishList::where('cookie_id', $this->getCookieId('wishlist'))
            ->get();
            return $wish_lists->count('id');
        }

        return redirect()->route('wishlist')->with('success', 'Product added to wish list successfully!');
    }

    public function deleteProductFromCookie($id)
    {
        WishList::destroy($id);

        $wish_lists = WishList::where('cookie_id', $this->getCookieId('wishlist'))
        ->get();
        
        return $wish_lists->count('id');;
       
    }
}
