<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\delivary;
use App\Order;
use App\OrderDetails;
use App\Cart;
use DB;

class DelivaryController extends Controller
{
     public function index()
    {
    	return view('delivary.index');
    }

    public function order()
    {   
        $xs=Delivary::where('status','On The Way')->orwhere('status','Delivered')->orwhere('status','To the Delivery Man')->orwhere('status','Customer Not Found')->orderBy('id','asc')->get(); 
    	return view('delivary.order',compact('xs'));
    }

      public function view($id){

    	$order=Order::find($id);
    	$details=OrderDetails::where('order_no',$id)->get();
        $total=Cart::all()->where('order_no',$id)->sum(function($t){
    return $t->price*$t->quantity;
  });
    	return view('delivary.OrderView',compact('order','details','total','id'));
    	
    }

    public function edit($id)
    { 
      $d=Delivary::find($id);
    	$x=Delivary::where('order_id',$id)->get();
    	return view('delivary.edit',compact('id','x','d'));
        
    }



   public function order_update(Request $request, $id)
    {   
   
   if($request->hasFile('sign'))
   {
   	$image=$request->file('sign');
   	$location=$image->getClientOriginalName();
   	$image->move(public_path('img/products/'),$location);

   }

        
$update_product = DB::table('delivaries')
                    ->where('order_id', $id)
                    ->update([
                              'delivered_by'=>$request->dname,
                               'delivary_time'=>$request->time,
                              'image' => $request->file('sign')->getClientOriginalName(),
                           ]);
    	
   
            
      return redirect()->route('delivary.orders')->with('d','Delivary information is updated');

  }
public function order_save(Request $request, $id){

$update_order = DB::table('orders')
                    ->where('id', $id)
                    ->update(['status' =>  $request->status]);
$update_product = DB::table('delivaries')
                    ->where('order_id', $id)
                    ->update(['status' =>  $request->status]);

  return redirect()->back()->with('n','Your delivery status has been updated.');;
}


    

    
}
