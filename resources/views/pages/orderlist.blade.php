@extends('layouts.homepage')
@section('content')


  
<div class='container margin-top-20'>

	 @php
             $count=DB::table('orders')->where('user_id', Auth::id())->where('status','!=','pending')->count();
             @endphp
             @if($count==0)
 
             	<h2 style="text-align: center;">You have no order</h2>
	@else
	 <h2 style="text-align: center;">My Orders</h2>
		<table class="table table-bordered table-stripe">

	<thead class="thead-dark">
		<tr>
			<th>Serial</th>
			<th>Order NO.</th>
			<th>Amount</th>
			<th>Delivery Charge</th>
			<th>Order Status</th>
			<th>Date</th>
			<th>
				Action
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach($orders as $o)
		
<tr>
	<td class>
	<h5>	{{ $loop->index+1}} </h5>
	</td>
	<td>
		<h5>{{ $o->id }}</h5>
	</td>
	<td> 
      <h5>{{ $o->amount-$o->delivery }}</h5>
	</td>
	<td> 
      <h5>{{ $o->delivery }}</h5>
	</td>
	<td>
		<h5>{{ $o->status }}</h5>
	</td>
		<td>
	<h5>{{ $o->created_at }}</h5>
		</td>
		<td>
		<h5>  <a href="{{route('order.details',$o->id)}}" class="btn btn-info">Details</a> </h5>	
	</td>
	
</tr>

@endforeach

	</tbody>
</table>
@endif



</div>








@include('layouts.partial.footer')
@endsection