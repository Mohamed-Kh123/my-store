<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    private function save(Category $category, Request $request)
    {
        $file = $request->hasFile('image_path');
        if ($file) {
            $newFile = $request->file('image_path');
            $fileUpload = $newFile->store('categories', [
                'disk' => 'public'
            ]);
        }
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
            'slug' => 'unique:categories,slug',
            'description' => 'nullable',
            'image_path' => 'nullable|image|max:512000|dimensions:min_width=300,min_height=300',
            'status' => 'required|in:active,draft',
        ]);
        $name = $request->name;
        $parent_id = $request->parent_id;
        $description = $request->descriprion;
        $image_path = $fileUpload ?? null;
        $status = $request->status;

        $category->name = $name;
        $category->parent_id = $parent_id;
        $category->description = $description;
        $category->image_path = $image_path;
        $category->status = $status;
        $category->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('category.view-any');

        $categories = Category::with('parent')->paginate();
        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('category.create');

        $category = new Category();
        $parents = Category::all();
        return view('admin.categories.create', [
            'category' => $category,
            'parents' => $parents,
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
        Gate::authorize('category.create');

        $category = new Category();

        $this->save($category, $request);

        return redirect()->route('categories.index')->with('success', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('category.view');

        $category = Category::findOrFail($id);

        return view('admin.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('category.update');

        $category = Category::findOrFail($id);
        $parents = Category::all();

        return view('admin.categories.edit', [
            'category' => $category,
            'parents' => $parents,
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
        Gate::authorize('category.update');

        $category = Category::findOrFail($id);

        $this->save($category, $request);
        
        return redirect()->route('categories.index')->with('success', "Category $category->id Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('category.delete');

        $category = Category::findOrFail($id);
        $category->delete();

        Storage::disk('public')->delete($category->image_path);

        return redirect()->back()->with('success', "Category $category->name Deleted!");
    }
}
