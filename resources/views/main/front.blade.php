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
		
				
<div class="col-md-12">

  <div class="widget">
 
    <div class="row">
       
        
   
    @foreach ($products as $product)
          <div class="col-md-3">
             <div class="card" >
                  @php $i = 1; @endphp

                  @foreach ($product->images as $image)
                
                    @if ($i > 0 )
                     <a href="{!! route('item.show',$product->slug) !!}">
                        <img class="card-img-top feature-img" src="{{ asset('public/img/products/'. $image->image) }}" alt="{{ $product->title }}" >
                      </a>
                    @endif

                    @php $i--; @endphp
                  @endforeach

           <div class="card-body">
           <h4 class="card-title">
           <a href="{!! route('item.show',$product->slug) !!}">{{ $product->title }}</a>
          </h4>
                 <p class="card-text"> Price: {{ $product->prize }} Tk. </p>
                <form action="{{ url('addcart',$product->id) }}" method="POST">
                  @csrf
              <input type="hidden" name="price" value="{{ $product->prize }}">
             <button type="submit"><i class="icon-shopping-cart"></i>  Add to Cart </button> </form>

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