@extends('layouts.homepage')

@section('content')
<div class='container margin-top-20'>
  <div class="row">
    <div class="col-md-4">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
     @foreach ($product->images as $image)
           <div class="carousel-item active">
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
    <h3>{{ $product->prize }} Taka </h3>
      <h4> Available in Stock <span class="badge badge-secondary">{{ $product->quantity }} </span>  </h4>
    <hr>
    <div class="product-description">
      <h5> Description: {!! $product->description !!} </h5>

    </div>
  </div>
  <div class="widget">
    
  </div>
</div>
</div>
</div>

@include('layouts.partial.footer')
@endsection