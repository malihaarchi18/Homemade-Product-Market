@extends('admin.layouts.master')
@section('content')


<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">
             <b>   Add Category </b>
              </div>
              <div class="card-body">
             <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              @if(session('msg'))
            <div class="alert alert-success" role="alert">
            {{ session('msg') }}

            </div>

             @endif
              @include('admin.partials.message')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control"name="name" id="exampleInputEmail1">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
 <textarea name="description" rows="8" cols="80" class="form-control"></textarea>
  </div> 


  <div class="form-group">
    <label for="exampleInputPassword1">Parent Category</label>
  <input type="text" class="form-control"name="name" id="exampleInputEmail1">

  </div>
   
   <div class="form-group">
    <label for="product_image">Attach Category Image</label>
    <input type="file" class="form-control"name="product image" id="category_image">
  </div>
 
  <button type="submit" class="btn btn-primary">Add Category</button>
</form>
            </div>
            </div>
        </div>
        </div>

        @endsection


        <!-- <select class="form-control" name="parent_id">
  @foreach($main_categories as $category)
<option value="{{ $category->id }}"> {{ $category->name }} </option>
@endforeach
</select>
 -->