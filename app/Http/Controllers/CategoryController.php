<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::select('name','id')->get();
        $brands = Brand::select('name','id')->get();
        $sizes = Size::select('size','id')->get();
        $colors = Color::select('name','id')->get();
        $dimensions = Dimension::select('dimension','id')->get();
        $tags = Tag::select('name','id')->get();


        $products = Product::with(['category' => function($q){
            $q->select('name', 'id');
        }]);


        if($request->has('category')){
            $products->whereHas('category', function($q){
                $values = array();
                $values = request()->category;
                $q->whereIn('category_id', $values);
            });
        }
        if($request->has('brand')){
            $products->whereHas('brands', function($q){
                $values = array();
                $values = request()->brand;
                $q->whereIn('brand_id', $values);
            });
        }
        if($request->has('size')){
            $products->whereHas('sizes', function($q){
                $values = array();
                $values = request()->size;
                $q->whereIn('size_id', $values);
            });
        }
        if($request->has('color')){
            $products->whereHas('colors', function($q){
                $values = array();
                $values = request()->color;
                $q->whereIn('color_id', $values);
            });
        }
        if($request->has('dimension')){
            $products->whereHas('dimensions', function($q){
                $values = array();
                $values = request()->dimension;
                $q->whereIn('dimension_id', $values);
            });
        }
        if($request->has('sortBy')){
            if($request->sortBy == 'trending'){
                $products->where('is_trending', '=', true);
            }
            if($request->sortBy == 'name'){
                $products->orderBy('name', 'asc');
            }
            if($request->sortBy == '-name'){
                $products->orderBy('name', 'desc');
            }
            if($request->sortBy == 'price'){
                $products->orderBy('price', 'desc');
            }
            if($request->sortBy == '-price'){
                $products->orderBy('price', 'asc');
            }
            if($request->sortBy == '-rating'){
                $products->orderBy('total_ratings', 'asc');
            }
            if($request->sortBy == 'rating'){
                $products->orderBy('total_ratings', 'desc');
            }
        }

        if($request->expectsJson()){
            $data = $products->paginate();
            return response()->json(['data' => $data]);
        }
        
        $products = $products->paginate(15);
        
        return view('front.category', [
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
            'sizes' => $sizes,
            'colors' => $colors,
            'dimensions' => $dimensions, 
            'tags' => $tags,
        ]);
    }

    
}
