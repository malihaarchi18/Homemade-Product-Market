<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Cart;
use App\OrderDetails;
use App\delivary;
use Auth;
use DB;

class OrderController extends Controller
{
    public function index(){
    	$orders=Order::orderBy('id','asc')->where('status','!=','pending')->paginate(10);
    	return view('admin.pages.order.index')->with('orders', $orders);
    }

     public function view($id){
         $update_product = DB::table('orders')
                    ->where('id', $id)
                    ->update(['seen_by_admin' => 'YES']);
    	$order=Order::find($id);
    	$details=OrderDetails::where('order_no',$id)->get();
        $total=Cart::all()->where('order_no',$id)->sum(function($t){
    return $t->price*$t->quantity;
  });
    	return view('admin.pages.order.view',compact('order','details','total'));
    	
    }

    public function confirm(Request $request,$id)
    {   
            $check=Delivary::where('order_id',$id)->first();
            if($check)
            {
                 $update_order = DB::table('delivaries')
                    ->where('order_id', $id)
                    ->update(['status' =>  $request->status]);
            }
            else
            {
          delivary::insert([
               'order_id'=>$id,
               'status'=>$request->status,
              
 ]);
      }
        $update_product = DB::table('orders')
                    ->where('id', $id)
                    ->update(['status' =>  $request->status]);
                     return redirect()->back()->with('msg','Order Status is updated');;
        


      

    }

    public function delete($id)
     {
        Db::table('orders')->where('id',$id)->delete();
        return redirect()->back()->with('msg','Order has been deleted');
     }

     public function delivary($id)
     {
       $d=Delivary::where('order_id',$id)->first();
       return view('admin.pages.order.delivary',compact('id','d'));
     }
}
