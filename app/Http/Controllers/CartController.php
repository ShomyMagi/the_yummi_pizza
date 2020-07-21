<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{   
    public function index()
    {
        try
        {
            return view('cart');
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
    
    public function getCart()
    {
        try
        {
            $cart = new Cart();
            $data = $cart->getCart();
            return response()->json($data);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
    
    public function addToCart($id)
    {
        try
        {
            $cart = new Cart();
            $cart->addToCart($id);
            return response(200);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
    
    public function deleteFromCart($id)
    {
        try
        {
            $cart = new Cart();
            $cart->deleteCart($id);
            return response(200);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
    
    public function deleteCart()
    {
        try
        {
            $cart = new Cart();
            $cart->delete();
            return response(200);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
    
    public function countCart()
    {
        try
        {
            $cart = new Cart();
            $data = $cart->countCart();
            return response()->json($data);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
    
    public function countCartId()
    {
        try
        {
            $cart = new Cart();
            $data = $cart->countIdCart();
            return response()->json($data);
            
        } catch (Exception $ex) {
            \Log::error($ex->getMessage());
        }
    }
}
