<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if($user->type == "حمامة"){
            $orders = Order::where('delivery_name', 'حمامة')->paginate();
            return view('admin.orders.delivery', compact('orders'));
        }

        if($user->type == "يمامة"){
            $orders = Order::where('delivery_name', 'يمامة')->paginate();
            return view('admin.orders.delivery', compact('orders'));
        }

        if($user->type == "حودة"){
            $orders = Order::where('delivery_name', 'حودة')->paginate();
            return view('admin.orders.delivery', compact('orders'));
        }
        
        if($user->type == "user"){
            return abort(403);
        }
    }
}
