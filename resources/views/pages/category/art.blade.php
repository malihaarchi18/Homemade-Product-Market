@extends('layouts.homepage')

@section('content')
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
  

   <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="bread"><span>Category</span> / <span>Art & Crafts</span></p>
          </div>
        </div>
      </div>
    </div>

<div class="breadcrumbs-two">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="breadcrumbs-img" style="background-image: url({{asset('public/img/products/art.jpg')}}">
            </div>
           
          </div>
        </div>
      </div>
    </div>

<div class='container margin-top-20'>
    @if(Session::has('range'))
            <div class="alert alert-info" role="alert">
            {{ Session::get('range') }}

            </div>

             @endif
  <div class="row">

    <div class="col-md-4">
      <br>
      <div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action"><h6 style="font size: 10px;"><b>ORDER BY</b></h6></a>
             <a href="{{ route('art1')}}" class="list-group-item list-group-item-action"><input type="checkbox"> <b> Low To High </b> </input></a>
              
              <a href="{{ route('art2')}}" class="list-group-item list-group-item-action"><input type="checkbox"> <b> High To Low </b> </input></a>
             
          </div>
        </div>




        <div class="col-md-8">
    </div>
  </div>
</div>

<br><br>



<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action"><h6 style="font size: 10px;"><b>FILTER BY</b></h6></a>
             <a href="#" class="list-group-item list-group-item-action"><input type="checkbox"> <b> New Arrivals </b> </input></a>
              
               <a href="#" class="list-group-item list-group-item-action"><input type="checkbox"> <b> Available Products</b> </input></a>
              <a href="#" class="list-group-item list-group-item-action"><input type="checkbox"> <b> Products On Sale </b> </input></a>
             
          </div>
        </div>




        <div class="col-md-8">
    </div>
  </div>
</div>
</div>



<div class="col-md-8">

  <div class="widget">
    <h3><b> Art & Crafts Category </b> </h3>
    <br>
    <div class="row">
       
        
      @foreach ($products as $product)
      @if($product->category_name=='Art & Crafts')
          <div class="col-md-4">
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
                   <div class="off"> <h4 style="color:#dc3535;" > <b> -{{$product->Sale}}%   </b></h4> </div>
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
</div>

@include('layouts.partial.footer')
@endsection