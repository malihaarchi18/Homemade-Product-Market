<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Image;


class CategoryController extends Controller
{
     public function index()
    {   
        $categories = Category::orderBy('id','asc')->get();
        return view('admin.pages.category.index')->with('categories',$categories);
    }

    public function create ()
    {   
    	$main_categories = Category::orderBy('name','asc')->where('parent_id',NULL)->get();
    	return view('admin.pages.category.create', compact('main_categories'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required' ,
    		'image' => 'nullable|image',
    	],

    	[

    	'name.required' => 'Name is required',
    	'image.image' => 'Provide a valid image',

    	]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

         if( is_countable ($request->image) > 0) {
            
            $img=$request->file('image');
            $img=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('img/products/'  .$img);
            Image::make($image)->save($location);
            $category->image= $img;
            }

        $category->save();

        return redirect()->route('admin.category.create')->with('msg','Category has been added successfully');
    }

    public function edit($id)
    {   
        $main_categories = Category::orderBy('name','asc')->where('parent_id',NULL)->get(); 
        $category = Category::find($id);
        return view('admin.pages.category.edit',compact('category'));
        
    }

    public function update(Request $request, $id)
    {   


     $request->validate([
    'name'       => '|required|max:150',
    'description' => '|required',
    'parent_id'       => '|required|numeric',
    
    
        ]);
     
        $category= Category::find($id);

        $category->title=$request->name;
        $category->description=$request->description;
        $category->parent_id=$request->parent_id;
        $category->save();
        
   
            
      return redirect()->route('admin.categories');

  }



  public function delete($id)
    {   
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories')->with('dltmsg','The category has been deleted');
}

}
