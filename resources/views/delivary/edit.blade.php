@extends('delivary.index')
@section('content')


<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <h2 style="text-align: center;"> Order No. {{ $id }} </h2>
              <div class="card-header">
             <b>   Edit Order </b>

           
           </div>
              <div class="card-body">
             <form action="{{ route('delivary.update',$id)}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              @include('admin.partials.message')
  <div class="form-group">
    <label for="exampleInputEmail1">Delivered By</label>
    <input type="text" value=""class="form-control"name="dname" id="exampleInputEmail1" autocomplete="off">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Delivery Date</label> <br>

  <input type="date" value="" id="time" name="time">
  </div>
  <div class="form-group">
    <label for="product_image">Attach Signature Image</label>
    <input type="file" value="" class="form-control"name="sign" id="sign_image">
    <button type="submit" class="btn btn-primary">Upload Image</button>
  </div>
   
   
 
 
</form>
            
            
          
             

            </div>
            </div>
        </div>
        </div>

        @endsection