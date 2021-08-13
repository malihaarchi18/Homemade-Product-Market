@extends('layouts.homepage')

@section('content')
<div class='container margin-top-20'>



 
   @if(session('ok'))
          <div class="alert alert-success" role="alert">

        {{ session('ok') }}

         </div>


           @endif

  <div class="row">

     
    <div class="col-md-4">
 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
     @foreach ($product->images as $image)
           <div class="carousel-item active">
             @if($product->Sale != 0)
                   <div class="off"> <h4 style="color:#dc3535;" > <b>-{{$product->Sale}}%   </b></h4> </div>
                   @endif
           <img class="d-block w-100" src="{!! asset('public/img/products/'.$image->image)!!}" alt="First slide">
           <hr>

           </div>
           
 
     @endforeach

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class="mt-3">
 <h4> Category: <span class="badge badge-dark">{{ $product->category_name }} </span></h4>
 <h4> A product by <span class="badge badge-dark">{{ $product->shop_name }}</span></h4>
  </div>
  </div>






<div class="col-md-8">
  <div class="widget">
    <h3>{{ $product->title }}</h3>
    @if($product->Sale==0)
    <h3>{{ $product->prize }} Taka </h3>
    @else
   <h3> <b style="text-decoration: line-through;"> {{ $product->prize }} Tk. </b> <b>{{$product->prize-($product->Sale/100)*$product->prize}} Tk. </b></h3> 
    @endif
    @if($product->quantity == 0)
     <h4 style="color:#dc3535;"> <b> Out of Stock ❌</b></h4>
    @else
      <h4> Available in Stock <span class="badge badge-secondary">{{ $product->quantity }} </span>  </h4>
      @endif
    <hr>
    <div class="product-description">
      <h5> Description: {!! $product->description !!} </h5>

    </div>
  </div>


  <div class="widget">
    
  </div>
</div>
@guest
 @if (Route::has('register'))
 <div class="review">
    <h4> Please <a style="color:blue;"href="{{route('login')}}">login</a> or <a style="color:blue;"href="{{route('register')}}">Sign up</a> to add review. </h4>
  </div>
  @endif
    @else

@if($xy)
<form action="{{ url('review',[$product->id,$product->slug]) }}" method="POST">
    {{ csrf_field() }}
    

    <div class="review">
      <h4> Write your review here </h4>
    <input type="textarea" class="mytext" autocomplete="off" name="review">
  
  <button type="submit" class="button">Post</button>
</div>
</form>
@else
   
   <div class="review">
   <h4> You can not add review as you haven't purchased the product yet. </h4>
 </div>
 

@endif
@endguest




</div>
<div class="cmnt">
@foreach($review as $r)
<h4><b> {{ $r->user_name }} </b><i class="fa fa-calendar" style="font-size:15px;"></i> {{ $r->created_at }}</h4>
<h5><i class="fas fa-pencil-alt"></i>{{$r->review}}</h5>
<br>
@endforeach
</div> 


    <h2 style="text-align: center;"><b> You can also like </b> </h2>
    <br><br>
    <div class="row">
       
        

      @foreach ($similar as $s)
          <div class="col-md-3">
             <div class="card" >
                  @php $i = 1; @endphp

                  @foreach ($s->images as $image)
                
                    @if ($i > 0 )
                    <div class="wishlist">
                     <a href="{{ route('item.show',[$s->slug,$s->id]) }}">
                        <img class="card-img-top feature-img" src="{{ asset('public/img/products/'. $image->image) }}" alt="{{ $s->title }}" >
                      </a>

                      <div class="w">
                         <form action="{{ url('wishlist',$s->id) }}" method="POST">
                          @csrf
                       <button type="submit" style="border:black; background-color: transparent;">  <i class="fa fa-heart" style="color:#bd2130; font-size:18px; border:black;"></i> </button>
                       
                      </form>

                      </div>
                          @if($s->Sale != 0)
                   <div class="off"> <h4 style="color:#dc3535;" > <b> {{$s->Sale}}%   </b></h4> </div>
                   @endif
                    </div>
                    @endif

                    @php $i--; @endphp
                  @endforeach

           <div class="card-body">
           <h4 class="card-title">
           <a href="{{ route('item.show',[$s->slug,$s->id]) }}">{{ $s->title }}</a>
          </h4>
          @if($s->Sale==0)
              <p class="card-text"> <b> Price: {{ $s->prize }} Tk. </b></p>
          @else
                 <p class="card-text"> <b> Price: </b> <b style="text-decoration: line-through;"> {{ $s->prize }} Tk.</b>  <b>{{$s->prize-($s->Sale/100)*$s->prize}} Tk.</b>  </p> 
              @endif
                
                  @if($s->quantity == 0)
                 <h4 style="color:#dc3535;"> <b> Out of Stock ❌</b></h4>
                 @else
                <form action="{{ url('addcart',[$s->id,$s->quantity]) }}" method="POST">
                  @csrf
              <input type="hidden" name="price" value="{{ $s->prize }}">
             <button type="submit" class="acart"><i class="icon-shopping-cart"></i>  Add to Cart </button> </form>@endif

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
@endsection