<?php

namespace App\Http\Controllers;

use App\Events\PaymentCreated;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Payment\PaymentMethod;
use App\Repositories\Payment\PaypalPayment;
use App\Repositories\Payment\StripePayment;
use Illuminate\Http\Request;


class PaymentsController extends Controller
{
  protected $pay;

  public function __construct(PaymentMethod $pay)
  {
    $this->pay = $pay;
  }
  public function createPayment(Order $order)
  {
    return view('front.Payments.create', [
      'order' => $order,
    ]);
  }

  public function create(Order $order)
  {
    return $this->pay->create($order);
    
  }

  public function confirm(Order $order)
  {

    return $this->pay->confirm($order);

  }
}
