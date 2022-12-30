<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('message.view-any');
        $messages = MessageContact::paginate();
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('message.view');
        $message = MessageContact::findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('message.delete');
        MessageContact::destroy($id);
        return redirect()->back()->with('Message deleted!');
    }
}
