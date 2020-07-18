<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    
    public $order;
    public $first_name;
    public $last_name;
    public $address;
    public $email_address;
    public $mobile_number;
    public $total_price;
    
    public function order()
    {
        $order = Order::insert([
            'order' => $this->order,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'email_address' => $this->email_address,
            'mobile_number' => $this->mobile_number,
            'total_price' => $this->total_price
        ]);
        return $order;
    }
}
