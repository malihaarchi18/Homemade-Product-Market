@extends('layouts.homepage')
@section('content')

 <h2 style="text-align: center;">Details of Order No. {{$id}}</h2>
<div class='container margin-top-20'>

<table class="table table-bordered table-stripe">
  <thead>
  <tr> <th>
     <h3 style="text-align: center;">Shipping Information:</h3><br>
                  <p style="text-align: center;"><strong> Name: </strong> {{ $o->name }}</p>
                <p style="text-align: center;"><strong>Contact No.: </strong> {{ $o->phone }}</p>
                <p style="text-align: center;"><strong>Email: </strong> {{ $o->email }}</p>
                <p style="text-align: center;"><strong>Shipping Address: </strong> {{ $o->address }}</p></th>
  </tr>
</thead>
</table>

<table class="table table-bordered table-stripe">
  <thead>
    <tr>
      <th>No.</th>
      <th>Product Title</th>
      <th>Product Image</th>
      <th>Discount(%)</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
    @foreach($info as $i)

<tr>
  <td>
  <h5>  {{ $loop->index+1}} </h5>
  </td>
  <td>
    <h5>  <a href="{{route('item.show',[$i->product->slug,$i->product->id]) }}">{{ $i->product->title}}</h5></a>
  </td>
  <td> 

<img src="{{ asset('public/img/products/'. $i->product->images->first()->image)}}" width="100px" height="70px">
  </td>
  <td>
    <h5>{{ $i->sale }}</h5>
  </td>
  <td>
    <h5>{{ $i->price }}</h5>
  </td>
    <td>
    <h5>  {{ $i->quantity }}  </h5>

  </td>
    <td>
    <h5>  {{$i->price*$i->quantity}} </h5>

  </td>
</tr>

@endforeach

  </tbody>
</table>




</div>
@include('layouts.partial.footer')
@endsection