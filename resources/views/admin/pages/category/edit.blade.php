@extends('admin.layouts.master')
@section('content')


<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">
             <b>   Edit Category </b>
           </div>
              <div class="card-body">
             <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              @include('admin.partials.message')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control"name="title" id="exampleInputEmail1" value="{{ $category->name }}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label> 

    <textarea name="description" rows="8" cols="80" class="form-control"> {{ $category->description }} </textarea>
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Parent Category</label>
  <input type="text" class="form-control"name="parent_category" id="exampleInputEmail1" value="{{ $category->parent_id }}">

  </div>

   
   <div class="form-group">
    <label for="product_image">Attach Product Image</label>
    <input type="file" class="form-control"name="category image" id="category_image">
  </div>
 
  <button type="submit" class="btn btn-primary">Update Category</button>
</form>
            </div>
            </div>
        </div>
        </div>

        @endsection