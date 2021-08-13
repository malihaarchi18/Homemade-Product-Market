@extends('admin.layouts.master')
@section('content')


<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">
          <b>  Request for Refund  </b>
              </div>
              <div class="card-body">
             <form action="{{ route('refund.request') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              @if(session('x'))
            <div class="alert alert-success" role="alert">
            {{ session('x') }}

            </div>

             @endif

               @if(session('y'))
            <div class="alert alert-warning" role="alert">
            {{ session('y') }}

            </div>

             @endif

              @include('admin.partials.message')
              <div class="form-group">
    <label for="exampleInputEmail1">Order ID</label><br>
    <input type="number" style="width:500px;" class="form-control"name="order_id" id="exampleInputEmail1">
  </div>
<div class="form-group">
    <label for="exampleInputEmail1">Transaction</label>
    <input type="text" class="form-control"name="transaction" id="exampleInputEmail1" autocomplete="off">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Refund Amount</label><br>
    <input type="number" style="width:500px;" class="form-control"name="refund" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Reason</label>
    <input type="text" class="form-control"name="reason" id="exampleInputEmail1" autocomplete="off">
  </div>
 

 
  <button type="submit" class="btn btn-primary">Request</button>
</form>
            </div>
            </div>
        </div>
        </div>

        @endsection