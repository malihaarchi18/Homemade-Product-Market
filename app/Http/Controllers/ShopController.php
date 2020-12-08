<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{
    public function shop1()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('shop.shop1')->with('products',$products);
    }

     public function shop2()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('shop.shop2')->with('products',$products);
    }

     public function shop3()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('shop.shop3')->with('products',$products);
    }
}
