<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CouponsController extends Controller
{
    private function save(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|size:10',
            'amount' => 'required|int',
            'type' => 'required|in:percent,fixed',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $coupon->code = $request->code;
        $coupon->amount = $request->amount;
        $coupon->type = $request->type;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('coupon.view-any');
        $coupons = Coupon::paginate();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('coupon.create');
        $coupon = new Coupon();
        return view('admin.coupons.create', compact('coupon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('coupon.create');

        $coupon = new Coupon();
        
        $this->save($request, $coupon);

        return redirect()->route('coupons.index')->with('success', 'Coupon added successfully!');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.edit', compact('coupon'));
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
        Gate::authorize('coupon.update');

        $coupon = Coupon::findOrFail($id);
        
        $this->save($request, $coupon);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('coupon.delete');
        Coupon::destroy($id);
        return redirect()->back()->with('success', 'Coupon deleted!');
    }
}
