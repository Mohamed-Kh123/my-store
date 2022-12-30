<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('order.view-any');

        $orders = Order::paginate();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('order.view');

        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('order.update');

        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
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
        Gate::authorize('order.update');

        $request->validate([
            'status' => 'required|in:pending,cancelled,processing,shipped,completed',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('Order #'.$order->number.' updated!');
    }

}
