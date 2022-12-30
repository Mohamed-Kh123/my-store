<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Review;
use App\Repositories\Register\Register;
use App\Repositories\Users\AdminUser;
use App\Repositories\Users\Auth as UsersAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{

    
    public function index()
    {
        $latestProducts = Product::with('category')->latest()->limit(6)->get();
        $bestSales = Product::with('category')->where('number_of_sales', '>', 0)->orderBy('number_of_sales', 'DESC')->limit(6)->get();
        $categoryLap = Category::where('name', '=', 'laps')->first();
        $lapProducts = Product::with('category')->where('category_id', '=', $categoryLap->id)->limit(6)->get();
        $categoryTv = Category::where('name', '=', 'Tv')->first();
        $tvProducts = Product::with('category')->where('category_id', '=', $categoryTv->id)->limit(6)->get();
        $trendingProducts = Product::with('category')->where('is_trending', '=', true)->limit(6)->get();

        


        return view('front.home', [
           'latestProducts' => $latestProducts,
            'bestSales' => $bestSales,
            'lapProducts' => $lapProducts,
            'tvProducts' => $tvProducts,
            'trendingProducts' => $trendingProducts,
        ]);
    }
}
