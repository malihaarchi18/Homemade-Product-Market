<!DOCTYPE HTML>
<html>
	<head>
	<title>E-mart</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

@include('layouts.partial.style')
	</head>
	<body>
	@include('layouts.partial.nav')


	<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
				
			    
			 	<li style="background-image:url({{asset('public/img/products/a2.jpg')}}">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Welcome to Emart</h1>
					   					<h2 class="head-2">Exclusive</h2>
					   					<h2 class="head-3">Collection</h2>
					   					<p class="category"><span>New trending Items</span></p> <br>
					   					<p><a href="{{ route('products') }}" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			
			   <li style="background-image:url({{asset('public/img/products/bgjpg.jpg')}}">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Huge</h1>
					   					<h2 class="head-2">Sale</h2>
					   					<h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2><br>
					   					<p><a href="{{ route('products') }}" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>

			
			 <li style="background-image:url({{asset('public/img/products/z2.jpg')}}">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">New</h1>
					   					<h2 class="head-2">Arrival</h2>
					   					<h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off</h2><br>
					   				<!--	<p class="category"><span>New stylish shoes for men</span></p> -->
					   					<p><a href="{{ route('products') }}" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			  	</ul>
		  	</div>
		  </li>
		</aside>

		<div class="colorlib-intro">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h2 class="intro">To encourage people's creativity and turn hobbies into well-organzed businesses is what we devote ourselves for ❤️</h2>
					</div>
				</div>
			</div>
		</div>

	@include('layouts.partial.some')

		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
						<h2>Trending Now</h2>
					</div>
				</div>
			</div>
		</div>


		 @if(session('cart'))
            <div class="alert alert-success" role="alert">
            {{ session('cart') }}

            </div>

             @endif

             @if(session('wish'))
            <div class="alert alert-success" role="alert">
            {{ session('wish') }}

            </div>

             @endif
	
		
				
<div class="col-md-12">

  <div class="widget">
 
    <div class="row">
       
        
   
    @foreach ($items as $i)
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
                      	 <form action="{{ url('wishlist',$i->product->id) }}" method="POST">
                      	 	@csrf
                       <button type="submit" style="border:black; background-color: transparent;">  <i class="fa fa-heart" style="color:#bd2130; font-size:18px; border:black;"></i> </button>
                       
                    </form>
                      </div>
                        @if($i->product->Sale != 0)
                   <div class="off"> <h4 style="color:#dc3535;" > <b> -{{$i->product->Sale}}%   </b></h4> </div>
                   @endif
                    </div>
                    @endif

                    @php $i--; @endphp
                  @endforeach

           <div class="card-body">
           <h4 class="card-title">
           <a href="{{route('item.show',[$i->product->slug,$i->product->id]) }}">{{ $i->product->title }}</a>
          </h4>
             @if($i->product->Sale==0)
              <p class="card-text"> <b> Price:{{ $i->product->prize }} Tk. </b>  </p>
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
             <button type="submit" style="margin-left:40px;"class="acart"><i class="icon-shopping-cart"></i>  Add to Cart </button> </form>

          </div>
          </div>
          </div>

@endforeach






 

    </div>
  <div class="widget">
    
  </div>
</div>
</div>





@include('layouts.partial.footer')
	</div>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	
@include('layouts.partial.script')

	</body>
	</html>