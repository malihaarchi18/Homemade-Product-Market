@extends('admin.layouts.master')
@section('content')


<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">
             <b>   Add Coupon </b>
              </div>
              <div class="card-body">
             <form action="{{ route('admin.coupon.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              @if(session('msg'))
            <div class="alert alert-success" role="alert">
            {{ session('msg') }}

            </div>

             @endif
              @include('admin.partials.message')
  <div class="form-group">
    <label for="exampleInputEmail1">Coupon Name</label>
    <input type="text" class="form-control" name="coupon_name" id="exampleInputEmail1">
  </div>
 <div class="form-group">
    <label for="exampleInputEmail1">Coupon Code</label>
    <input type="number" class="form-control" name="coupon_code" id="exampleInputEmail1">
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Discount(%)</label>
    <input type="number" class="form-control"name="discount" id="exampleInputEmail1">
  </div>
 
  <button type="submit" class="btn btn-primary">Add Coupon</button>
</form>
            </div>
            </div>
        </div>
        </div>

        @endsection
