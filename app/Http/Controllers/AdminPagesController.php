<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Str;
use Image;

class AdminPagesController extends Controller
{
    public function index()
    {
    	return view('admin.pages.index');
    }

   
     
    
}
