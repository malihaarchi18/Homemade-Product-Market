<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Str;
use Image;
use App\message;

class AdminPagesController extends Controller
{
    public function index()
    {
    	return view('admin.pages.index');
    }
    public function message(Request $request)
    {
    	message::insert([
               'first_name'=>$request->fname,
               'last_name'=>$request->lname,
               'email'=>$request->email,
               'contact_no'=>$request->contact,
               'subject'=> $request->subject,
               'message'=> $request->message,
 ]);
    

     return redirect()->back()->with('mm','Thank you');;

  }

  public function feedback()   
  {
  	$ms= Message::orderBy('id','asc')->get();
  	return view('admin.msg',compact('ms'));
  }
  public function msg_view($id)
  {
    $ms= Message::find($id);
    return view('msg2',compact('ms'));
  }
    
}
