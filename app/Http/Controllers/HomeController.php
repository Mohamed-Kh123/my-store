<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Review;
use App\Models\Statistic;
use App\Repositories\Register\Register;
use App\Repositories\Users\AdminUser;
use App\Repositories\Users\Auth as UsersAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    
    public function index()
    {
        $products = Product::with('category')->limit(6);
        $latestProducts = $products->latest()->get();
        $bestSales = $products->where('number_of_sales', '>', 0)->orderBy('number_of_sales', 'DESC')->get();
        $lapProducts = $products->get();
        $tvProducts = $products->get();
        $trendingProducts = $products->where('is_trending', '=', true)->get();

        
        $visitor = new Statistic();
        $value = $visitor->getValue('visitors');
        if($value){
            $visitor->setValue('visitors', DB::raw('value + 1'));
        }
        if(!$value){
            $visitor->setValue('visitors', 1);
        }

        return view('front.home', [
           'latestProducts' => $latestProducts,
            'bestSales' => $bestSales,
            'lapProducts' => $lapProducts,
            'tvProducts' => $tvProducts,
            'trendingProducts' => $trendingProducts,
        ]);
    }
}
