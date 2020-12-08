<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Str;
use Image;

class AdminProductController extends Controller
{   
     public function index()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('admin.pages.product.index')->with('products',$products);
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
        $product->quantity=$request->quantity;
        $product->save();
    	
   
            
      return redirect()->route('admin.products');

  }



    public function product_store(Request $request)
    {   


     $request->validate([
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

     
    
}

