<?php

namespace App\Http\Controllers;
use App\Product;
//use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $data;
    
    public function index()
    {
        try
        {
            $product = new Product();
            $this->data["products"] = $product->getProducts();
            return view('index', $this->data);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
    
    public function getProducts()
    {
        try
        {
            $products = new Product();
            $data = $products->getProducts();
            return response()->json($data);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
    
}
