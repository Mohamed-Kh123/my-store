<?php
namespace App\Repositories\Payment;

use App\Models\Order;
use Illuminate\Http\Request;

interface PaymentMethod{

    public function create(Order $order);
    public function confirm(Order $order);

}