<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AboutUsController extends Controller
{
    public function create()
    {
        Gate::authorize('aboutUs.create');
        $aboutUs = AboutUs::find(1);
        if(!$aboutUs){
            $aboutUs = new AboutUs();
        }
        return view('admin.aboutUs.create', [
            'aboutUs' => $aboutUs,
        ]);
    }

    public function update(Request $request)
    {   
        Gate::authorize('aboutUs.create');

        $request->validate([
            'content' => "string|required",
            'image_path' => "nullable",
            'title' => "string|required",
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            
            $image_path = $file->store('aboutUs', [
                'disk' => 'public',
            ]);
        }
        
        AboutUs::updateOrCreate([
            'id' => 1,
        ], [
            'content' => $request->content,
            'title' => $request->title, 
            'image_path' => $image_path ?? null,
        ]);

        return redirect()->back()->with('success', 'About us updated!');
    }
}
