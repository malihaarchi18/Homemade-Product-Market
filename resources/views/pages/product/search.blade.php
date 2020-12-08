@extends('layouts.homepage')

@section('content')
<div class='container margin-top-20'>
  <div class="row">
    <div class="col-md-4">
     <div class="container">
  <div class="row">
    <div class="col-md-8">

      
      <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action"><h6 style="font size: 10px;"><b>Select a Range</b></h6></a>
<br>
              
     <form action="{{ route('search')}}"  method="Get">
    
                        <input type="number" name="min"  placeholder="Minimum Price">
                        <br> <br>
                        <input type="number" name="max"  placeholder="Maximum Price">
                        
                       <br><br>
                        <input type="submit" name="submit"> 
                    
                 
                  </form>
 
                      
                    
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
  @if(session('cart'))
            <div class="alert alert-success" role="alert">
            {{ session('cart') }}

            </div>

             @endif

               @if(session('product'))
            <div class="alert alert-success" role="alert">
            {{ session('product') }}

            </div>

             @endif
             
  <div class="widget">
    <br>
    <h3>Showing results For - <span class="badge badge-dark"> {{ $search }} </span></h3>
    <br>
    <div class="row">
       
        

      @foreach ($products as $product)
      
          <div class="col-md-4">
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
                 <form action="{{ url('addcart',[$product->id,$product->quantity])}}" method="POST">
                  @csrf
              <input type="hidden" name="price" value="{{ $product->prize }}">
             <button type="submit"><i class="icon-shopping-cart"></i>  Add to Cart </button> </form>

          </div>
          </div>
          </div>

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