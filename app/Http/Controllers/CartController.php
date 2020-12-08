<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Cart;
use App\Coupon;
use Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function addToCart(Request $request,$product_id,$stock){
    
    $check= Cart::where('product_id',$product_id)->where('user_ip',request()->ip())->first();
    if ($check)
    {
    Cart::where('product_id',$product_id)->where('user_ip',request()->ip())->increment('quantity');
      return redirect()->back()->with('cart','Product added on cart');
    }


      else{
      Cart::insert([
               'product_id'=>$product_id,
               'quantity'=>1,
               'price'=>$request->price,
               'user_ip'=> request()->ip(),
               'user_id'=> Auth::id(),
               'stock'=> $stock,
 ]);



   return redirect()->back()->with('cart','Product added on cart');;

}
    
}

public function cartpage(){
  $carts=Cart::where('user_ip',request()->ip())->latest()->get();
  $total=Cart::all()->where('user_ip',request()->ip())->sum(function($t){
    return $t->price*$t->quantity;
  });
  return view('pages.cart',compact('carts','total'));
  
}

public function remove($cart_id)
{
  Cart::where('id',$cart_id)->where('user_ip',request()->ip())->delete();
  return redirect()->back()->with('cart_dlt','Product removed from cart');;
}


  public function quantityupdate(Request $request, $cart_id){

$x=Cart::where('id',$cart_id)->where('stock','>=',$request->product_quantity)->where('user_ip',request()->ip())->first();
$y=Cart::where('id',$cart_id)->where('stock','<',$request->product_quantity)->where('user_ip',request()->ip());

if($x)
{
Cart::where('id',$cart_id)->where('stock','>=',$request->product_quantity)->where('user_ip',request()->ip())->update([
     'quantity'=>$request->product_quantity,]);
return redirect()->back()->with('cart_update','Quantity Updated');;
}

else if($y)
{
  return redirect()->back()->with('fail','Sorry!☹️ The quantity you chose is insufficient at the moment!');;
}
}

public function applyCoupon(Request $request){
  $check=Coupon::where('coupon_code',$request->coupon)->first();
  if($check){
   Session::put('coupon',[
       'coupon_code'=> $check->coupon,
       'coupon_name'=>$check->coupon_name,
       'discount'=> $check->discount,
    ]);
    return redirect()->back()->with('valid','Successfully Coupon Applied');;
  }
  else
  {
    return redirect()->back()->with('invalid','Your coupon is invalid');;
  }
}

public function removeCoupon(){
  Session::forget('coupon');
  return redirect()->back()->with('rmv','Coupon removed.');;
}








}