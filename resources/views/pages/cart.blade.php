@extends('layouts.homepage')
@section('content')
<div class='container margin-top-20'>
	@if(session('cart_dlt'))
            <div class="alert alert-danger" role="alert">
            {{ session('cart_dlt') }}

            </div>

             @endif


             @if(session('valid'))
            <div class="alert alert-success" role="alert">
            {{ session('valid') }}

            </div>

             @endif

             @if(session('invalid'))
            <div class="alert alert-danger" role="alert">
            {{ session('invalid') }}

            </div>

             @endif

             @if(session('fail'))
            <div class="alert alert-danger" role="alert">
            {{ session('fail') }}

            </div>

             @endif


             @if(session('cart_update'))
            <div class="alert alert-success" role="alert">
            {{ session('cart_update') }}

            </div>

             @endif


             @if(session('rmv'))
            <div class="alert alert-info" role="alert">
            {{ session('rmv') }}

            </div>

             @endif
             
             @php
             $count=DB::table('carts')->where('user_id', Auth::id())->count();
             $quantity=App\Cart::where('user_ip',request()->ip())->where('user_id',Auth::id())->sum('quantity');
             @endphp
             @if($count==0)
 
             	<h2>No product in your cart</h2>
             
           
	@else
	<h2>My Shopping Cart</h2>
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
		@if($cart->user_id == Auth::id())

<tr>
	<td>
	<h5>	{{ $loop->index+1}} </h5>
	</td>
	<td>
		<h5>  <a href="{{route('item.show',[$cart->product->slug,$cart->product->id]) }}">{{ $cart->product->title}}</h5></a>
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
		<input type="number" name="product_quantity" id="quantity" min="1" max="{{$cart->product->quantity}}" value="{{ $cart->quantity}}"/><button type="submit" class="btn btn-success">Update</button></form>
		

	</td>
		<td>
		<h5>	{{$cart->price*$cart->quantity}} </h5>

	</td>
	<td>
	<a href="{{ url('cart/remove',$cart->id)}}"> <span style='font-size:20px;'>&#10006;</span></a>
	</td>
</tr>
@endif
@endforeach

	</tbody>
</table>
<br><br>

<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="total-wrap">
							<div class="row">
								
								<div class="col-sm-8">
						
									<div class="row form-group">
											<div class="col-sm-9">
												<form action="{{ url('coupon/apply')}}" method="POST">
												 @csrf
												<input type="text" autocomplete="off" name="coupon" class="form-control input-number" placeholder="Your Coupon Code...">
												<button type="submit" class="btn btn-primary">Apply Coupon</button>
										</form><br>
		
	
									</div>
										</div>
			                  
								</div>
						 <div class="col-sm-4 text-center">
									<div class="total">
										<div class="sub">
											<p style="font-size:17px"><span><b>Subtotal:</b></span> <span>{{ $total}} Taka</span></p>
											@if($quantity<6)
											<p style="font-size:17px"><span><b>Delivary Charge:</b></span> <span>50 Taka</span></p>
											@elseif(5<$quantity && $quantity<11)
											<p style="font-size:17px"><span><b>Delivary Charge:</b></span> <span>100 Taka</span></p>
										    @else
											<p style="font-size:17px"><span><b>Delivary Charge:</b></span> <span>200 Taka</span></p>
											@endif

											@if(Session::has('coupon'))
                                             <p style="font-size:17px"><span><b>Coupon:</b></span> <span>{{ session()->get('coupon')['coupon_name']}}   <a href="{{url('coupon/remove')}}">❌</a></span></p>
											<p style="font-size:17px"><span><b>Discount:</b></span> <span>{{ session()->get('coupon')['discount']}} %</span></p>
											
											</div>
										<div>
										@if($quantity<6)
											<p style="font-size:17px"><span><b>Total:</b></span> <span>{{ $total+50-$total*session()->get('coupon')['discount']/100}} Taka</span></p>
                                          @elseif(5<$quantity && $quantity<11)
											<p style="font-size:17px"><span><b>Total:</b></span> <span>{{ $total+100-$total*session()->get('coupon')['discount']/100}} Taka</span></p>
                                            @else
											<p style="font-size:17px"><span><b>Total:</b></span> <span>{{ $total+200-$total*session()->get('coupon')['discount']/100}} Taka</span></p>
											@endif
										</div>
										
											@else
											<p style="font-size:17px"><span><b>Discount:</b></span> <span>0.00</span></p>
										</div>
										<div >
										 @if($quantity<6)
											<p style="font-size:17px"><span><b>Total:</b></span> <span>{{ $total+50}} Taka</span></p>
                                          @elseif(5<$quantity && $quantity<11)
											<p style="font-size:17px"><span><b>Total:</b></span> <span>{{ $total+100}} Taka</span></p>
                                            @else
											<p style="font-size:17px"><span><b>Total:</b></span> <span>{{ $total+200}} Taka</span></p>
											@endif

										</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

<div class="float-right">
<a href="{{ route('products') }}" class="btn btn-info btn-lg"><b style="font-size:18px">Continue Shopping</b></a>
@guest
 @if (Route::has('register'))
<a href="{{ route('login') }}" class="btn btn-info btn-lg"><b style="font-size:18px">Please login to checkout</b></a>
 @endif
 @else
	<a href="{{ url('payment') }}" class="btn btn-info btn-lg"><b style="font-size:18px">Checkout</b></a>

@endguest
</div>


@endif




@include('layouts.partial.footer')
@endsection