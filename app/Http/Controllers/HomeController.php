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
        $latestProducts = Product::with(['category' => function($q){
            $q->select('id','name');
        }])->latest()->limit(6)->get(['id', 'name', 'price', 'discount', 'slug', 'image', 'total_ratings']);
        $bestSales = Product::with('category')->where('number_of_sales', '>', 0)->orderBy('number_of_sales', 'DESC')->limit(6)->get(['id', 'name', 'price', 'discount', 'slug', 'image', 'total_ratings']);
        $lapProducts = Product::with('category')->whereHas('category', function($q){
            $q->where('name', 'lap')->select(['id', 'name']);
        })->limit(6)->get(['id', 'name', 'price', 'discount', 'slug', 'image', 'total_ratings']);
        $tvProducts = Product::with('category')->whereHas('category', function($q){
            $q->where('name', 'Tv')->select(['id', 'name']);
        })->limit(6)->get(['id', 'name', 'price', 'discount', 'slug', 'image', 'total_ratings']);
        $trendingProducts = Product::with('category')->where('is_trending', '=', true)->limit(6)->get(['id', 'name', 'price', 'discount', 'slug', 'image', 'total_ratings']);


        return view('front.home', [
           'latestProducts' => $latestProducts,
            'bestSales' => $bestSales,
            'lapProducts' => $lapProducts,
            'tvProducts' => $tvProducts,
            'trendingProducts' => $trendingProducts,
        ]);
    }
}
