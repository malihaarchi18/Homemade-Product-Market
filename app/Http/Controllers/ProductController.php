<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;



class ProductController extends Controller
{   

	public function index(){
		$products=Product::orderBy('id','asc');
		return view('admin.pages.product.index')->with('products', $products);
	}
    public function show($slug){
    	$product = Product::where('slug',$slug)->first();
    	if(!is_null($product)){
                return view('pages.product.show',compact('product'));
    	}else {
    		return redirect()->route('item')->with('msg','No product available');
    	}
    }
}
