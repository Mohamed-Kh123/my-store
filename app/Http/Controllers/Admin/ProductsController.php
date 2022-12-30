<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDimension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductsController extends Controller
{
    private function save(Product $product, Request $request)
    {
        $images = array();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', [
                    'disk' => 'public',
                ]);
                $images[] = $path;
            }
            $product->image = $images;
        }

        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|array|image|max:512000|dimensions:min_width=300,min_height=300',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'dimension' => 'nullable',
            'discount' => 'nullable',
            'status' => 'required|in:active,draft',
        ]);

        $name = $request->name;
        $category_id = $request->category_id;
        $description = $request->description;
        $price = $request->price;
        $quantity = $request->quantity;
        $discount = $request->discount;
        $status = $request->status;


       
        
        $product->name = $name;
        $product->category_id = $category_id;
        $product->description = $description;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->discount = $discount;
        $product->status = $status;
        $product->save();
        $dimensions = [];

        foreach($request->dimension ?? [] as $dimension){
                $dimensions[] = [
                    'product_id' => $product->id,
                    'dimension_id' => $dimension,
                ];
            }
        if(!$product->dimensions()){
            $product->dimensions()->attach($dimensions);
        }
        $product->dimensions()->detach();
        $product->dimensions()->attach($dimensions);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('product.view-any');
        $products = Product::with(['category', 'dimensions'])->simplePaginate(10);
        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('product.create');
        $product = new Product();
        $categories = Category::all();
        $dimensions = Dimension::all();

        return view('admin.products.create', [
            'product' => $product,
            'categories' => $categories,
            'dimensions' => $dimensions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('product.create');

        $product = new Product();

        $this->save($product, $request);
        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('product.update');

        $product = Product::findOrFail($id);
        $categories = Category::all();
        $dimensions = Dimension::all();


        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'dimensions' => $dimensions,
        ]);
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
        Gate::authorize('product.update');

        $product = Product::findOrFail($id);

        $this->save($product, $request);

        return redirect()->route('products.index')->with('success', "Product $product->name Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('product.delete');

        $product = Product::findOrFail($id);

        $product->delete();

        // Storage::disk('uploads')->delete($product->image);

        return redirect()->back()->with('success', "Product $product->name Deleted!");
    }
}
