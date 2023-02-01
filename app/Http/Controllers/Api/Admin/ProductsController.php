<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private function save($product, Request $request)
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category.parent', 'dimensions'])->get();
        return  ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        
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
            'name' => 'required|max:255',
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

        return response()->json([
            'success' => 'Product created!',
            'product' => $product,
        ], 201);
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
        $product = Product::findOrFail($id);

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
            'name' => 'sometimes|required|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'image' => 'nullable|array|image|max:512000|dimensions:min_width=300,min_height=300',
            'description' => 'nullable',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|numeric',
            'dimension' => 'nullable',
            'discount' => 'nullable',
            'status' => 'sometimes|required|in:active,draft',
        ]);
       
        $product->update($request->all());
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

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return response()->json([
            'success' => 'Product deleted!',
        ]);
    }
}
