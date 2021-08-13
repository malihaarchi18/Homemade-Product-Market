<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\wishlist;
use App\review;
use App\OrderDetails;


class ProductController extends Controller
{   

	public function index(){
		$products=Product::orderBy('id','asc');
		return view('admin.pages.product.index')->with('products', $products);
	}


    public function show($slug, $id){
    	$product = Product::where('slug',$slug)->first();
      $category=$product->category_name;
      $similar=Product::where('category_name',$category)->latest()->get();
      $review= review::where('slug',$slug)->get();

$xy= OrderDetails::where('product_id',$id)->where('user_id',Auth::id())->first();


    	if(!is_null($product)){
                return view('pages.product.show',compact('product','review','xy','similar'));
    	}else {
    		return redirect()->route('item')->with('msg','No product available');
    	}
    }

    public function addToWishlist($product_id)
    {  
        $check= Wishlist::where('product_id',$product_id)->where('user_ip',request()->ip())->where('user_id',Auth::id())->first();
        if($check)
        {   
      
      return redirect()->back()->with('m','The product is already on your wishlist');
        }
        else{
            Wishlist::insert([
               'product_id'=>$product_id,
               'quantity' => 1,
               'user_id'=> Auth::id(),
               'user_ip' =>request()->ip(),
               
 ]);
        return redirect()->back()->with('wish','Product added on wishlist');
    }



    }


    public function wishlistpage()
    {
        $product=Wishlist::where('user_id',Auth::id())->where('user_ip',request()->ip())->latest()->get();
        return view('pages.wishlist',compact('product'));
    }

    public function remove($product_id)
{
  Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->delete();
  return redirect()->back()->with('dlt','Product removed from wishlist');;
}


public function review(Request $request,$product_id,$slug)
{  
    
    Review::insert([

         'user_id' =>  Auth::id(),
          'user_name' => Auth::user()->name,
          'product_id' => $product_id,
          'slug' => $slug,
          'review'  => $request->review,



    ]);

return redirect()->back()->with('ok','Thanks for your feedback');

}

    
}
