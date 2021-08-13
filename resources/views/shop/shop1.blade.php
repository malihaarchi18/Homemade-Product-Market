@extends('layouts.homepage')

@section('content')


<!------ Include the above in your HEAD tag ---------->
<br>
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

             @if(session('m'))
            <div class="alert alert-info" role="alert">
            {{ session('m') }}

            </div>

             @endif
  
            <div class="container">    
                <div class="jumbotron">
                  <div class="row">
                      <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">

                          <img src="{{asset('public/img/products/f.png')}}">
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                          <div class="container" style="border-bottom:1px solid black">
                            <h2><b>Shop Name: Fashion Fiesta</b></h2>
                            <h2>Category: <span class="badge badge-dark"> Clothing </span> <span class="badge badge-dark"> Home & Living </span></h2>
                          </div>
                            <hr>
                          <ul class="container details">
                             <h3>Owner Name: Wasiqul Hoque</h3>
                             <h5>Adrress: Gollamari, Khulna</h5>
                             <h5>Contact No. 01710-010101</h5>
                             <h5>mail: fashion_fiesta@yahoo.com</h5>

                          </ul>
                      </div>
                  </div>
                </div>




<br>
<div class="col-md-12">

  <div class="widget">
    <div class="shop"><h2><b> Our Products </b> </h2>
    <br>
    <div class="row">
       
        

      @foreach ($products as $product)
      @if($product->shop_name=='Fashion Fiesta')
          <div class="col-md-3">
             <div class="card" >
                  @php $i = 1; @endphp

                  @foreach ($product->images as $image)
                
                    @if ($i > 0 )
                    <div class="wishlist">
                     <a href="{{ route('item.show',[$product->slug,$product->id]) }}">
                        <img class="card-img-top feature-img" src="{{ asset('public/img/products/'. $image->image) }}" alt="{{ $product->title }}" >
                      </a>

                      <div class="w">
                         <form action="{{ url('wishlist',$product->id) }}" method="POST">
                          @csrf
                       <button type="submit" style="border:black; background-color: transparent;">  <i class="fa fa-heart" style="color:#bd2130; font-size:18px; border:black;"></i> </button>
                       
                      </form>

                      </div>
                          @if($product->Sale != 0)
                   <div class="off"> <h4 style="color:#dc3535;" > <b> {{$product->Sale}}%   </b></h4> </div>
                   @endif
                    </div>
                    @endif

                    @php $i--; @endphp
                  @endforeach

           <div class="card-body">
           <h4 class="card-title">
           <a href="{{ route('item.show',[$product->slug,$product->id]) }}">{{ $product->title }}</a>
          </h4>
          @if($product->Sale==0)
              <p class="card-text"> <b> Price: {{ $product->prize }} Tk. </b>  </p>
          @else
                 <p class="card-text"> <b> Price: </b> <b style="text-decoration: line-through;"> {{ $product->prize }} Tk.</b>  <b>{{$product->prize-($product->Sale/100)*$product->prize}} Tk.</b>  </p> 
              @endif
                
                  @if($product->quantity == 0)
                 <h4 style="color:#dc3535;"> <b> Out of Stock ❌</b></h4>
                 @else
                <form action="{{ url('addcart',[$product->id,$product->quantity]) }}" method="POST">
                  @csrf
                   <input type="hidden" name="salep" value="{{ $product->Sale }}">
                @if($product->Sale==0)
              <input type="hidden" name="price" value="{{ $product->prize }}">
              @else
               <input type="hidden" name="price" value="{{ $product->prize-($product->Sale/100)*$product->prize }}">
               @endif
            
             <button type="submit" class="acart"><i class="icon-shopping-cart"></i>  Add to Cart </button> </form>@endif

          </div>
          </div>
          </div>
@endif
@endforeach






 

    </div>

  </div>
  <div class="widget">
    
  </div>
</div>
</div>


@include('layouts.partial.footer')
@endsection