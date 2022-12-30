<?php
namespace App\Repositories\Payment;

use App\Events\PaymentCreated;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class StripePayment implements PaymentMethod{
    public function create(Order $order)
    {
        $stripe = new \Stripe\StripeClient(
            config('services.stripe.secret_key')
          );
          $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $order->total,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
          ]);

          return [
            'clientSecret' => $paymentIntent->client_secret,
          ];
    }

    public function confirm(Order $order)
    {
      $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
      $paymentIntent = $stripe->paymentIntents->retrieve(
        request()->query('payment_intent'),
        []
      );

        if($paymentIntent->status == "succeeded"){
          $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'currancy' => $paymentIntent->currency,
            'payment_method' => 'stripe',
            'status' => 'completed',
            'transaction_id' => $paymentIntent->id,
            'transaction_data' => json_encode($paymentIntent),
          ]);

          event(new PaymentCreated($payment));

          return redirect()->route('home');
        }
    }

}