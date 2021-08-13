@extends('admin.layouts.master')
@section('content')

<div class="main-panel">
          <div class="content-wrapper">
          	 <div class="card">
              <div class="card-header">
<h2 style="text-align: center;"> Delivery Information of {{$id}} No. Order </h2>
<p> 
	  @if( is_null($d->delivered_by))
	  <b> Delivered By: N/A </b> 
	  @else
<b> Delivered By: {{ $d->delivered_by }} </b>
@endif
</p>
<p>  @if( is_null($d->delivary_time))
	  <b> Delivery Date : N/A </b> 
	  @else
<b> Delivery Date : {{ $d->delivary_time }} </b>
@endif</p>
<p> <b>
	 @if( is_null($d->image))
	  <b> Signature of Customer: N/A </b> 
@else
 Signature of Customer: <img class="height: 400px; width: 400px;" src="{{ asset('public/img/products/'. $d->image) }}" alt="Card image" > </b>
 @endif </p>
</div>
</div>
</div>
</div>
















@endsection