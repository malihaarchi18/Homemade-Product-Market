@extends('layouts.homepage')

@section('content')
<br>
 @if(Session::has('range'))
            <div class="alert alert-info" role="alert">
            {{ Session::get('range') }}

            </div>

             @endif
@if(session('cart'))
            <div class="alert alert-success" role="alert">
            {{ session('cart') }}

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
              
               <a href="#" class="list-group-item list-group-item-action"><input type="checkbox"> <b> Most Trending </b> </input></a>
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
                  <form action="{{ url('addcart',[$product->id,$product->quantity]) }}" method="POST">
                  @csrf
              <input type="hidden" name="price" value="{{ $product->prize }}">
             <button type="submit"><i class="icon-shopping-cart"></i>  Add to Cart </button> </form>

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