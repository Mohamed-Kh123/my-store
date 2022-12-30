<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use function Ramsey\Uuid\v1;

class TagsController extends Controller
{
    private function save(Tag $tag, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag->name = $request->name;
        $tag->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('tag.view-any');

        $tags = Tag::withCount('products')->paginate();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('tag.update');

        $tag = new Tag();
        return view('admin.tags.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('tag.create');

        $tag = new Tag();

        $this->save($tag, $request);

        return redirect()->route('tags.index')->with('success', 'Tag added Successfully!');
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
        Gate::authorize('tag.update');

        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));

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
        Gate::authorize('tag.update');
        $tag = Tag::findOrFail($id);
        $this->save($tag, $request);

        return redirect()->route('tags.index')->with('success', 'Tag updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('tag.delete');
        Tag::destroy($id);
        return redirect()->back()->with('success', 'Tag deleted!');
    }
}
