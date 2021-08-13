@extends('layouts.homepage')
@section('content')
 
<div class='container margin-top-20'>
    @if(Session::has('dlt'))
            <div class="alert alert-danger" role="alert">
            {{ Session::get('dlt') }}

            </div>

             @endif

             @if(session('cart'))
            <div class="alert alert-success" role="alert">
            {{ session('cart') }}

            </div>

             @endif
	 @php
             $count=DB::table('wishlists')->where('user_ip',request()->ip())->where('user_id', Auth::id())->count();
             @endphp
             @if($count==0)
 
             	<h2 style="text-align: center;">Your Wishlist is empty</h2>
             	@else
<h2 style="text-align: center;">My Wishlist</h2>
@endif
<div class="row">



            
	
@foreach($product as $i)
 <div class="col-md-3">
             <div class="card" >
                  @php $x = 1; @endphp

                  @foreach ($i->product->images as $image)
                
                    @if ($x > 0 )
                    <div class="wishlist">
                     <a href="{{ route('item.show',[$i->product->slug,$i->product->id]) }}">
                        <img class="card-img-top feature-img" src="{{ asset('public/img/products/'. $image->image) }}" alt="{{ $i->product->title }}" >
                      </a>

                      <div class="w">
                        <a href="{{ route('wishlist.remove',$i->product_id)}}"> <i class="fa fa-trash"></i></a>
                      </div>
                        @if($i->product->Sale != 0)
                   <div class="off"> <h4 style="color:#dc3535;" > <b> -{{$i->product->Sale}}%   </b></h4> </div>
                   @endif
                  </div>
                    @endif

                    @php $x--; @endphp
                  @endforeach

           <div class="card-body">
           <h4 class="card-title">
           <a href="{{ route('item.show',[ $i->product->slug,$i->product->id ])}}">{{ $i->product->title }}</a>
          </h4>
            @if($i->product->Sale==0)
              <p class="card-text"> <b> Price: {{ $i->product->prize }} Tk. </b>  </p>
          @else
                 <p class="card-text"> <b> Price: </b> <b style="text-decoration: line-through;"> {{ $i->product->prize }} Tk.</b>  <b>{{$i->product->prize-($i->product->Sale/100)*$i->product->prize}} Tk.</b>  </p> 
              @endif 
                
                 
                <form action="{{ url('addcart',[$i->product->id,$i->product->quantity]) }}" method="POST">
                  @csrf
              <input type="hidden" name="salep" value="{{ $i->product->Sale }}">
                @if($i->product->Sale==0)
              <input type="hidden" name="price" value="{{ $i->product->prize }}">
              @else
               <input type="hidden" name="price" value="{{ $i->product->prize-($i->product->Sale/100)*$i->product->prize }}">
               @endif
             <button type="submit" class="acart"><i class="icon-shopping-cart"></i>  Add to Cart </button> 
             </form>
   

          </div>
          </div>
          </div>
@endforeach

</div>










	</div>



@include('layouts.partial.footer')
 @endsection