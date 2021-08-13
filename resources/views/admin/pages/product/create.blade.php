@extends('admin.layouts.master')
@section('content')


<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">
             <b>   Add Product </b>
              </div>
              <div class="card-body">
             <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              @if(session('msg'))
            <div class="alert alert-success" role="alert">
            {{ session('msg') }}

            </div>

             @endif
              @include('admin.partials.message')
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control"name="title" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>

    <textarea name="description" rows="8" cols="80" class="form-control"></textarea>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
   
  <select class="form-control" name="category_name">
      <option value="Art & Crafts">Art& Crafts</option>
      <option value="Clothing">Clothing</option>
      <option value="Food Items">Food Items</ option>
      <option value="Gift and Jewellary">Gift &Jewellery</option>
   <option value="Home & Living" selected>Home & Living</option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Shop Name</label>
    <input type="text" class="form-control"name="shop_name" id="exampleInputEmail1">
  </div>
   

  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input type="number" class="form-control"name="prize" id="exampleInputEmail1">
  </div>

  
  
  <div class="form-group">
    <label for="exampleInputEmail1">Quantity</label>
    <input type="number" class="form-control"name="quantity" id="exampleInputEmail1">
  </div>
   
   <div class="form-group">
    <label for="product_image">Attach Product Image</label>
  <!--  <input type="file" class="form-control"name="product_image[]" id="product_image">
  </div> -->

   <div class="row">
    <div class="col-md-4">
      <input type="file" class="form-control"name="product_image[]" id="product_image">
    </div>

  </div>

 
  <button type="submit" class="btn btn-primary">Add Product</button>
</form>
            </div>
            </div>
        </div>
        </div>

        @endsection