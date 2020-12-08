<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Cart;

class OrderController extends Controller
{
    public function index(){
    	$orders=Order::orderBy('id','asc')->get();
    	return view('admin.pages.order.index',compact('orders'));
    }

     public function view($id){
    	$order=Order::find($id);
    	$carts=Cart::orderBy('id','asc')->get();
    	return view('admin.pages.order.view',compact('order','carts'));
    	
    }

}
