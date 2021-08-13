<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Order;
use App\refund;
use Illuminate\Support\Str;
use Image;
use DataTables;
use DB;

class AdminProductController extends Controller
{   
     public function index()
    {   
        $products = Product::orderBy('id','asc')->paginate(10);
        return view('admin.pages.product.index')->with('products',$products);
    }

     public function add_sale()
    {   
        $products = Product::orderBy('id','asc')->paginate(10);
        return view('admin.pages.product.sale')->with('products',$products);
    }

    public function sale_price(Request $request, $id)
    {   
        $product=Product::find($id);
        $price=$product->prize;
        $update_product = DB::table('products')
                    ->where('id', $id)
                    ->update(['Sale' =>  $request->sale,
                    'offer_price' => $price-($request->sale/100)*$price,
                ]);

                    return redirect()->back()->with('ns','Sale price is updated');
    }
   

    public function create()
    {
    	return view('admin.pages.product.create');
    }
   
   public function edit($id)
    {   
    	$product = Product::find($id);;
    	return view('admin.pages.product.edit')->with('product',$product);
        
    }



   public function product_update(Request $request, $id)
    {   


     $request->validate([
    'title'       => '|required|max:150',
    'description' => '|required',
    'category_name' => '|required|max:150',
    'shop_name' => '|required|max:150',
    'prize'       => '|required|numeric',
    'quantity'     => '|required|numeric',
        ]);
     
        $product= Product::find($id);

    	$product->title=$request->title;
    	$product->description=$request->description;
        $product->category_name=$request->category_name;
        $product->shop_name=$request->shop_name;
        $product->prize=$request->prize;
        $product->offer_price=$request->prize;
        $product->quantity=$request->quantity;
        $product->save();
    	
   
            
      return redirect()->route('admin.products');

  }



    public function product_store(Request $request)
    {   


     $this->validate($request,[
    'title'       => '|required|max:150',
    'description' => '|required',
    'category_name' => '|required|max:150',
    'shop_name' => '|required|max:150',
    'prize'       => '|required|numeric',
    'quantity'     => '|required|numeric',
        ]);
    	
    	$product=new Product;

    	$product->title=$request->title;
    	$product->description=$request->description;
        $product->category_name=$request->category_name;
        $product->shop_name=$request->shop_name;
        $product->prize=$request->prize;
        $product->offer_price=$request->prize;
        $product->quantity=$request->quantity;

        $product->slug=Str::slug($request->title);

        $product->category_id=1;
        $product->shop_id=1;
        $product->admin_id=1;
        $product->save();


        //ProductImage insert
        if( is_countable ($request->product_image) > 0) {
            foreach($request->product_image as $image)
        {
        	
        	$img=time().'.'.$image->getClientOriginalExtension();
        	$location=public_path('img/products/'  .$img);
        	Image::make($image)->save($location);

        	$product_image = new ProductImage;
        	$product_image->product_id = $product->id;
        	$product_image->image= $img;
        	$product_image->save();
            }

        }
        return redirect()->route('admin.product.create')->with('msg','Product
         has been added succesfully');




    }

    public function product_delete($id)
    {   
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.products')->with('dltmsg','Product has been deleted');
}

public function refund()
{
    return view('refund.request');
}

public function refund_request(Request $request)
{
$o=$request->order_id;
$t=$request->transaction;
$r=$request->refund;
$c=Order::where('id',$o)->first();


if($c)
{
    $s=$c->transaction_id;
    $re=$c->amount;
    if($t==$s && $r<=$re)
    {   
         refund::insert([
               'order_id'=> $request->order_id,
               'transaction_id'=>$request->transaction,
               'refund'=>$request->refund,
               'reason'=> $request->reason,
               'status'=> 'pending',
            
 ]);
        return redirect()->back()->with('x','Your refund request is successful.');
    }
    else
    {
       return redirect()->back()->with('y','Invalid Information.Check again.') ;
    }
}
else
{
    return redirect()->back()->with('y','Invalid Information.Check again.') ;
}
    
}

public function query_refund()
{
   $refund=Refund::orderBy('id','asc')->get();
   return view('refund.query',compact('refund'));
}

public function refund_view()
{  
    $refund=Refund::orderBy('id','asc')->get();
    return view('refund.view',compact('refund'));
}

public function refund_approve($id)
{  
    $update_status = DB::table('refunds')
                    ->where('id', $id)
                    ->update(['status' =>  'refunded']);

    return redirect()->back();
}


}


