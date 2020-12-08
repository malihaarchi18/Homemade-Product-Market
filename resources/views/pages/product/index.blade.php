@extends('layouts.homepage')

@section('content')
<div class='container margin-top-20'>
  <div class="row">

    <div class="col-md-4">
      @include('layouts.partial.product_sidebar')

</div>



<div class="col-md-8">

  @if(Session::has('product'))
            <div class="alert alert-info" role="alert">
            {{ Session::get('product') }}

            </div>

             @endif
    @if(session('cart'))
            <div class="alert alert-success" role="alert">
            {{ session('cart') }}

            </div>

             @endif

                @if(session('fail'))
            <div class="alert alert-danger" role="alert">
            {{ session('fail') }}

            </div>

             @endif
  <div class="widget">
    <h3><b> All Products </b> </h3>

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
                <form action="{{ url('addcart',[$product->id,$product->quantity]) }}" method="POST">
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