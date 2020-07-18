<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $request->validate([
            'first_name' => 'regex:/^[A-Z]{1}[a-z]{2,20}$/',
            'last_name' => 'regex:/^[A-Z]{1}[a-z]{4,25}$/',
            'email_address' => 'regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/',
            'address' => 'regex:/^[\w\d\s]{3,30}$/',
            'mobile_number' => 'regex:/^[\d\s]{5,20}$/',
        ]);
        
        try
        {
            $order = new Order();
            $order->order = $request->get('order');
            $order->first_name = $request->get('first_name');
            $order->last_name = $request->get('last_name');
            $order->address = $request->get('address');
            $order->email_address = $request->get('email_address');
            $order->mobile_number = $request->get('mobile_number');
            $order->total_price = $request->get('total_price');
            
            $data = $order->order();
            return response()->json($data);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
}
