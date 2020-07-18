<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    
    public function getProducts()
    {
        $products = Product::join('images', 'product_id', '=', 'id_product')
                ->orderBy('price', 'asc')
                ->get();
        return $products;
    }
    
}
