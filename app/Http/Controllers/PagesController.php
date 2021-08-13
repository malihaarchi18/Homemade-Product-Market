<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use App\Order;
use App\OrderDetails;
use App\Wishlist;
use Auth;
use DB;

class PagesController extends Controller
{

    public function contact()
    {
    	return view('pages.contact');
    }

    public function about()
    {   
        return view('pages.about');
    }

     public function front()
    {
        $items = OrderDetails::select('product_id')->distinct()->paginate(8);
        return view('main.front')->with('items',$items);
    }

     public function art()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.art')->with('products',$products);
    }
     public function art1()
    {   
        $products = Product::orderBy('offer_price','asc')->get();
        Session::flash('range','Minimum to Maximum Range');
        return view('pages.category.art')->with('products',$products);
        
    }
     public function art2()
    {   
        $products = Product::orderBy('offer_price','desc')->get();
        Session::flash('range','Maximum to Minimum Range');
        return view('pages.category.art')->with('products',$products);
    }

     public function cloth()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.cloth')->with('products',$products);
    }
       public function cloth1()
    {   
        $products = Product::orderBy('offer_price','asc')->get();
         Session::flash('range2','Minimum to Maximum Range');
        return view('pages.category.cloth')->with('products',$products);
    }
       public function cloth2()
    {   
        $products = Product::orderBy('offer_price','desc')->get();
          Session::flash('range2','Maximum to Minimum Range');
        return view('pages.category.cloth')->with('products',$products);
    }

     public function food()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.food')->with('products',$products);
    }
    public function food1()
    {   
        $products = Product::orderBy('offer_price','asc')->get();
         Session::flash('range3','Minimum to Maximum Range');
        return view('pages.category.food')->with('products',$products);
    }
    public function food2()
    {   
        $products = Product::orderBy('offer_price','desc')->get();
        Session::flash('range3','Maximum to Minimum Range');
        return view('pages.category.food')->with('products',$products);
    }

     public function gift()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.gift')->with('products',$products);
    }

     public function gift1()
    {   
        $products = Product::orderBy('offer_price','asc')->get();
         Session::flash('range4','Minimum to Maximum Range');
        return view('pages.category.gift')->with('products',$products);
    }

     public function gift2()
    {   
        $products = Product::orderBy('offer_price','desc')->get();
        Session::flash('range4','Maximum to Minimum Range');
        return view('pages.category.gift')->with('products',$products);
    }


     public function living()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.living')->with('products',$products);
    }

     public function living1()
    {   
        $products = Product::orderBy('offer_price','asc')->get();
         Session::flash('range5','Minimum to Maximum Range');
        return view('pages.category.living')->with('products',$products);
    }

     public function living2()
    {   
        $products = Product::orderBy('offer_price','desc')->get();
         Session::flash('range5','Maximum to Minimum Range');
        return view('pages.category.living')->with('products',$products);
    }

     public function price1()
    {   
       $products = Product::whereBetween('prize',['0','500'])->orderBy('prize','asc')->get();
       Session::flash('product','Products within the range of 0 to 500 Tk.');
      return view('pages.product.index',compact('products'));
       
    }

   public function price2()
    {    
  $products = Product::whereBetween('prize',['501','1000'])->orderBy('prize','asc')->get();
  Session::flash('product','Products within the range of 501 to 1000 Tk.');
  return view('pages.product.index',compact('products'));
    }

   



    public function products()
    {
        
    	$products = Product::orderBy('id','asc')->get();
    	return view('pages.product.index',compact('products'));
    }

    public function extra()
    {
      return view('pages.extra');
    }
    
         

  public function search(Request $request)
{   

    $products = Product::when($search = $request->search,function ($query, $search) {
        return $query->where('title', 'like', $pattern = "%{$search}%")
            ->orWhere('description', 'like', $pattern)
            ->orWhere('category_name', 'like', $pattern);
           
     })->when($request->submit, function ($query) {
        return $query->whereBetween('prize',['$request->min','$request->max']);
    }, function ($query) {
        return $query->orderBy('id');
    })->paginate(9);

  

    return view('pages.product.search', compact('search', 'products'));
    

    }


    public function myOrders()
    { 

      $orders=Order::where('user_id',Auth::id())->where('status','!=','Pending')->orderBy('id','desc')->get();
      
      return view('pages.orderlist',compact('orders'));
    }

    public function details($id)
    { 
      $o=Order::find($id);
      $info=OrderDetails::where('order_no',$id)->get();
      return view('pages.details',compact('info','id','o'));
    }
    public function new()
    {
      $products= Product::orderby('id','desc')->paginate(10);
      return view('pages.product.new',compact('products'));
    }
    public function available()
    {
      $products= Product::orderby('id','asc')->where('quantity','!=','0')->get();
      return view('pages.product.available',compact('products'));
    }

public function sale()
    { 

      $count=DB::table('products')->where('Sale','!=','0')->count();
      $products= Product::orderby('id','asc')->where('Sale','!=','0')->get();
     if($count==0)
      {
      return redirect()->back()->with('sale','There is no sale on any product now');
    }
    else
    {
       return view('pages.product.sale',compact('products'));
    }
    }




    
}
