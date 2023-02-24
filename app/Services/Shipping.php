<?php 

namespace App\Services;

use App\Models\Order;
use Shippo;
use Shippo_Shipment;
use Shippo_Transaction;

class Shipping 
{
    public function __construct()
    {
        Shippo::setApiKey(env('SHIPPO_PRIVATE'));
    }


    public function rates($id)
    {
        $order = Order::with('products')->where('id', $id)->first();
        // dd($order);
        // Grab the shipping address from the User model
        // $toAddress = $order['shipping_address'];
        // // Pass the PURCHASE flag.
        // $toAddress['object_purpose'] = 'PURCHASE';
        // // Get the shipment object

        $fromAddress = [
            'object_purpose' => 'PURCHASE',
            'name' => 'Shawn Ippotle',
            'company' => 'Shippo',
            'street1' => '215 Clayton St.',
            'city' => 'San Francisco',
            'state' => 'CA',
            'zip' => '94117',
            'country' => 'US',
            'phone' => '+1 555 341 9393',
            'email' => 'shippotle@goshippo.com'
        ];

        $toAddress = [
            'object_purpose' => 'PURCHASE',
            'name' => $order->shipping_name,
            'street1' => $order->shipping_address,
            'company' =>  $order->shipping_company_name,
            'city' => $order->shipping_city,
            'state' => $order->shipping_state,
            'zip' => $order->shipping_postcode,
            'country' => $order->shipping_country_name,
            'phone' => $order->shipping_phone_number,
            'email' => $order->shipping_email,
        ];

        $parcels = [
            'length'=> '5',
            'width'=> '5',
            'height'=> '5',
            'distance_unit'=> 'in',
            'weight'=> '2',
            'mass_unit'=> 'lb',
        ];

        
        return Shippo_Shipment::create([
                'object_purpose'=> 'PURCHASE',
                'address_from'=> $fromAddress,
                'address_to'=> $toAddress,
                'parcels'=> $parcels,
                'insurance_amount'=> '30',
                'insurance_currency'=> 'USD',
                'async'=> false,
        ]);
    }

    public function createLabel($rateId)
    {
        return Shippo_Transaction::create([
            'rate' => $rateId,
            'label_file_type' => "PDF",
            'async' => false
        ]);
    }
}