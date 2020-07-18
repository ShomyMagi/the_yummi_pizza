<?php

namespace App\Http\Controllers;
use App\Product;
//use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        try
        {
            return view('index');
            
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
