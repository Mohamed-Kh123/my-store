<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BrandsController extends Controller
{
    // private function storeOrUpdate(Request $request, $id = null)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //     ]);

    //     Brand::create([
    //         'name' => $request->name,
    //     ]);

    //     return redirect()->route('brands.index')->with('success', 'Brand added successfully!');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('brand.view-any');
        $brands = Brand::with('products')->paginate();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('brand.create');

        return view('admin.brands.create', [
            'brand' => new Brand(),
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
        Gate::authorize('brand.create');

        $request->validate([
            'name' => 'required',
        ]);

        Brand::create([
            'name' => $request->name,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand added successfully!');
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
        Gate::authorize('brand.update');

        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', [
            'brand' => $brand,
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
        Gate::authorize('brand.update');

        $request->validate([
            'name' => 'required',
        ]);

        $brand = Brand::findOrFail($id);

        $brand->update([
            'name' => $request->name,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('brand.delete');

        Brand::destroy($id);

        return redirect()->back()->with('success', 'Brand deleted!');
    }
}
