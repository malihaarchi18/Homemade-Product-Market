@extends('admin.layouts.master')
@section('content')




<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">

          
             <b>   View Orders </b>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                  <p><strong>Customer Name: </strong> {{ $order->name }}</p>
                <p><strong>Customer Contact No.: </strong> {{ $order->phone }}</p>
                <p><strong>Customer Email: </strong> {{ $order->email }}</p>
                <p><strong>Customer Address: </strong> {{ $order->address }}</p>


                  </div>
                  <div class="col-md-6">
                <p><strong>Total Amount: </strong> {{ $order->amount }}</p>
                <p><strong>Transaction ID: </strong> {{ $order->transaction_id }}</p>
               </div>
             </div>
             <hr>
             <h3>Ordered Items</h3>
           
             <table class="table table-bordered table-stripe">
  <thead>
    <tr>
      <th>No.</th>
      <th>Product Title</th>
      <th>Product Image</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total</th>
      <th>
        Remove
      </th>
    </tr>
  </thead>
  <tbody>
    
   
    @foreach($carts as $cart)
<tr>
  <td>
  <h5>  {{ $loop->index+1}} </h5>
  </td>
  <td>
    <h5>  <a href="{!! route('item.show',$cart->product->slug) !!}">{{ $cart->product->title}}</h5></a>
  </td>
  <td> 
    <img src="{{ asset('public/img/products/'. $cart->product->images->first()->image)}}" width="100px" height="70px">
  </td>
  <td>
    <h5>{{ $cart->price }}</h5>
  </td>
    <td>
  <form action="{{ url('cart/update',$cart->id)}}" method="post">
        @csrf
    <input type="number" name="product_quantity" id="quantity" min="1" max="{{$cart->stock}}" value="{{ $cart->quantity}}"/><button type="submit" class="btn btn-success">Update</button></form>
    

  </td>
    <td>
    <h5>  {{$cart->price*$cart->quantity}} </h5>

  </td>
  <td>
  <a href="{{ url('cart/remove',$cart->id)}}"> <span style='font-size:20px;'>&#10006;</span></a>
  </td>
</tr>
@endforeach

  </tbody>
</table>




                
            
            </div>
            </div>
        </div>
        </div>

        @endsection