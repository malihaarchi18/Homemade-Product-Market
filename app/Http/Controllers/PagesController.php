<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;

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
        $products = Product::orderBy('id','desc')->paginate(10);
        return view('main.front')->with('products',$products);
    }

     public function art()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.art')->with('products',$products);
    }
     public function art1()
    {   
        $products = Product::orderBy('prize','asc')->get();
        Session::flash('range','Minimum to Maximum Range');
        return view('pages.category.art')->with('products',$products);
        
    }
     public function art2()
    {   
        $products = Product::orderBy('prize','desc')->get();
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
        $products = Product::orderBy('prize','asc')->get();
         Session::flash('range','Minimum to Maximum Range');
        return view('pages.category.cloth')->with('products',$products);
    }
       public function cloth2()
    {   
        $products = Product::orderBy('prize','desc')->get();
          Session::flash('range','Maximum to Minimum Range');
        return view('pages.category.cloth')->with('products',$products);
    }

     public function food()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.food')->with('products',$products);
    }
    public function food1()
    {   
        $products = Product::orderBy('prize','asc')->get();
         Session::flash('range','Minimum to Maximum Range');
        return view('pages.category.food')->with('products',$products);
    }
    public function food2()
    {   
        $products = Product::orderBy('prize','desc')->get();
        Session::flash('range','Maximum to Minimum Range');
        return view('pages.category.food')->with('products',$products);
    }

     public function gift()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.gift')->with('products',$products);
    }

     public function gift1()
    {   
        $products = Product::orderBy('prize','asc')->get();
         Session::flash('range','Minimum to Maximum Range');
        return view('pages.category.gift')->with('products',$products);
    }

     public function gift2()
    {   
        $products = Product::orderBy('prize','desc')->get();
        Session::flash('range','Maximum to Minimum Range');
        return view('pages.category.gift')->with('products',$products);
    }


     public function living()
    {   
        $products = Product::orderBy('id','asc')->get();
        return view('pages.category.living')->with('products',$products);
    }

     public function living1()
    {   
        $products = Product::orderBy('prize','asc')->get();
         Session::flash('range','Minimum to Maximum Range');
        return view('pages.category.living')->with('products',$products);
    }

     public function living2()
    {   
        $products = Product::orderBy('prize','desc')->get();
         Session::flash('range','Maximum to Minimum Range');
        return view('pages.category.living')->with('products',$products);
    }

     public function price1()
    {   
       $products = Product::whereBetween('prize',['0','500'])->orderBy('prize','asc')->get();
       Session::flash('product','Products within the range of o to 500 Tk.');
      return view('pages.product.index',compact('products'));
       
    }

   public function price2()
    {    
  $products = Product::whereBetween('prize',['501','1000'])->orderBy('prize','asc')->get();
  Session::flash('product','Products within the range of 500 to 1000 Tk.');
  return view('pages.product.index',compact('products'));
    }

   



    public function products()
    {
        
    	$products = Product::orderBy('id','asc')->get();
    	return view('pages.product.index',compact('products'));
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




    
}
