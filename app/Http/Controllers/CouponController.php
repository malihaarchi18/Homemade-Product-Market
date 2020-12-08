<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
      public function index()
    {   
        $coupons = Coupon::orderBy('id','asc')->get();
        return view('admin.pages.coupon.index')->with('coupons',$coupons);
    }

    Public function create()
    {
    	return view('admin.pages.coupon.create');
    }

      public function store(Request $request)
    {   

        $this->validate($request,[
    		'coupon_name' => 'required' ,
    		'coupon_code' => '|required|numeric',
    		'discount'=> '|required|numeric',

    	]);
   
    	
    	$coupon=new Coupon;

    	$coupon->coupon_name=$request->coupon_name;
    	$coupon->coupon_code=$request->coupon_code;
    	$coupon->discount=$request->discount;
    	$coupon->status=1;
    	
    	
        $coupon->save();

        return redirect()->route('admin.coupon.create')->with('msg','Coupon has been added succesfully');




    }

   

}
