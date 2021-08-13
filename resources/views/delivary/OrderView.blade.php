@extends('delivary.index')
@section('content')

 @php
    $s=0;
     foreach($details as $d)
   $s=$s+$d->product->prize*$d->quantity
   @endphp

<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">

                  @if(session('msg'))
            <div class="alert alert-success" role="alert">
            {{ session('msg') }}

            </div>

             @endif

       <b>View Details of Order No. {{$id}}</b>
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
                  <p><strong> Amount:</strong> {{$order->amount-$order->delivery}}</p>
                <p><strong> Delivery Charge:</strong> {{$order->delivery}}</p>
                 <p><strong> Total Amount:</strong> {{$order->amount}}</p>
              
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
        <th>Product Quantity</th>
         <th>Unit Price</th>
          <th>SubTotal</th>

     
    
    </tr>
  </thead>
  <tbody>
   
    @foreach($details as $d)
   
<tr>
  <td>
  <h5>  {{ $loop->index+1}} </h5>
  </td>
  <td>
    <h5>  <a href="{{ route('item.show',[$d->product->slug,$d->product->id]) }}">{{ $d->product->title}}</h5></a>
  </td>
  <td> 

<img src="{{ asset('public/img/products/'. $d->product->images->first()->image)}}" width="100px" height="70px">
  </td>
  <td>
    <h5>{{ $d->quantity}}</h5>
  </td>
  <td>
    <h5>{{ $d->product->prize}}</h5>
  </td>
   <td>
    <h5>{{ $d->product->prize*$d->quantity}}</h5>
  </td>
  
  
</tr>
@endforeach

  </tbody>

</table>
<br>
</div>
</div>
</div>
@endsection