<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SizesController extends Controller
{
    private function save(Size $size, Request $request)
    {
        $request->validate([
            'size' => 'required|in:s,l,m,xl',
        ]);

        $size->size = $request->size;
        $size->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('size.view-any');

        $sizes = Size::withCount('products')->paginate();
        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('size.update');

        $size = new Size();
        return view('admin.sizes.create', compact('size'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('size.create');

        $size = new Size();

        $this->save($size, $request);

        return redirect()->route('sizes.index')->with('success', 'size added Successfully!');
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
        Gate::authorize('size.update');

        $size = Size::findOrFail($id);
        return view('admin.sizes.edit', compact('size'));

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
        Gate::authorize('size.update');
        $size = Size::findOrFail($id);
        $this->save($size, $request);

        return redirect()->route('sizes.index')->with('success', 'size updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('size.delete');
        Size::destroy($id);
        return redirect()->back()->with('success', 'Size deleted!');
    }
}
