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
        $wish_lists = WishList::with('products')->where('user_id', Auth::id())->orWhere('cookie_id', $this->getCookieId('wishlist'))->get();

        return view('front.wishlist', [
            'wish_lists' => $wish_lists,

        ]);
    }   
    public function storeWishList(Request $request)
    {
        $wish_list = WishList::where('product_id', $request->input('product_id'))->first();
        if($wish_list){
            return response()->json(['success' => 'Product already exists in the wish list!']);
        }
        WishList::create([
            'product_id' => $request->input('product_id'),
            'cookie_id' => $this->getCookieId('wishlist'),
            'user_id' => Auth::id() ?? null,
        ]);
        return redirect()->route('wishlist')->with('success', 'Product added to wish list successfully!');
    }

    public function deleteProductFromCookie(Request $request, $id)
    {
        WishList::destroy($id);

        return response()->json(['success' => 'Record deleted successfully!']);
       
    }
}
