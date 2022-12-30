<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('color.view-any');

        $colors = Color::withCount('products')->paginate();
        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('color.create');

        $color = new Color();
        return view('admin.colors.create', compact('color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('color.create');

        $request->validate([
            'name' => 'string|required',
        ]);

        Color::create([
            'name' => $request->name,
        ]);

        return redirect()->route('colors.index')->with('success', 'Color added successfully!');
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
        Gate::authorize('color.update');

        $color = Color::findOrFail($id);
        return view('admin.colors.edit', compact('color'));
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
        Gate::authorize('color.update');

        $request->validate([
            'name' => 'string|required',
        ]);
        $color = Color::findOrFail($id);
        $color->update([
            'name' => $request->name,
        ]);

        return redirect()->route('colors.index')->with('success', 'Color updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('color.delete');

        Color::destroy($id);

        return redirect()->back()->with('success', 'Color deleted!');
    }
}
