<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
 
    protected $table = 'cart';
    public $id;
    
    public function getCart()
    {
        $cart = Cart::join('products', 'id_product', '=', 'cart.product_id')
                ->join('images', 'images.product_id', '=', 'id_product')
                ->orderBy('created_cart_at', 'desc')
                ->get();
        return $cart;
    }
    
    public function addToCart($id)
    {
        $insert = Cart::insert([
           'product_id' => $id
        ]);
        return $insert;
    }
    
    public function deleteCart($id)
    {
        $delete = Cart::where('id_cart', '=', $id)
                ->delete();
        return $delete;
    }
    
    public function delete()
    {
        $delete = Cart::truncate();
        return $delete;
    }
    
    public function countCart()
    {
        $count = Cart::join('products', 'id_product', '=', 'cart.product_id')
                ->sum('price');
        return $count;
    }
}
