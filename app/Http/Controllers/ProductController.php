<?php

namespace App\Http\Controllers;

use App\Models\Dimension;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {   
        $product = Product::with('dimensions')->where('slug', '=', $slug)->firstOrFail();
        // dd($product->dimensions);
        $productsInSameCategory = Product::where('category_id', '=', $product->category_id)->limit(15)->get();
        
        
        return view('front.single-product', [
            'product' => $product,
            'productsInSameCategory' => $productsInSameCategory,
            'rating' => new Rating(),
        ]);
    }
    
}
