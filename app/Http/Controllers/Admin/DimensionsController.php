<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dimension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DimensionsController extends Controller
{
    private function save(Dimension $dimension, Request $request)
    {
        $request->validate([
            'dimension' => 'required|in:40x60cm,60x90cm,80x120cm',
        ]);

        $dimension->dimension = $request->dimension;
        $dimension->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('dimension.view-any');

        $dimensions = Dimension::withCount('products')->paginate();
        return view('admin.dimensions.index', compact('dimensions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('dimension.create');
        $dimension = new Dimension();
        return view('admin.dimensions.create', compact('dimension'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('dimension.create');

        $dimension = new Dimension();

        $this->save($dimension, $request);

        return redirect()->back()->with('success', 'Dimension added successfully!');
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
        Gate::authorize('dimension.update');

        $dimension = Dimension::findOrFail($id);

        return view('admin.dimensions.edit', compact('dimension'));
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
        Gate::authorize('dimension.update');

        $dimension = Dimension::findOrFail($id);

        $this->save($dimension, $request);

        return redirect()->back()->with('success', 'Dimension updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('dimension.delete');

        Dimension::destroy($id);

        return redirect()->back()->with('success', 'Dimension deleted!');
    }
}
