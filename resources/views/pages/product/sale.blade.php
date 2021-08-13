@extends('layouts.homepage')

@section('content')
<div class='container margin-top-20'>
  <div class="row">

    <div class="col-md-4">
      @include('layouts.partial.product_sidebar')

</div>



<div class="col-md-8">

 

              @if(Session::has('sale'))
            <div class="alert alert-info" role="alert">
            {{ Session::get('sale') }}

            </div>

             @endif
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

                @if(session('fail'))
            <div class="alert alert-danger" role="alert">
            {{ session('fail') }}

            </div>

             @endif
  <div class="widget">
    <h3><b> Products On Sale </b> </h3>

    <br>
    <div class="row">
 
      
        

      @foreach ($products as $product)
           <div class="col-md-4">
             <div class="card" >

                  @php $i = 1; @endphp

                  @foreach ($product->images as $image)
                
                    @if ($i > 0 ) 
                    <div class="wishlist">
                     <a href="{{ route('item.show',[$product->slug, $product->id])}}">
                        <img class="card-img-top feature-img" src="{{ asset('public/img/products/'. $image->image) }}" alt="{{ $product->title }}" >
                      </a>
                     
                      <div class="w">
                        <form action="{{ route('wishlist',$product->id) }}" method="POST">
                          @csrf
                        <button type="submit" style="border:black; background-color: transparent;">  <i class="fa fa-heart" style="color:#bd2130; font-size:18px; border:black;"></i> </button>
                       </form>
                      </div>
                      @if($product->Sale != 0)
                   <div class="off"> <h4 style="color:#dc3535;" > <b> -{{$product->Sale}}%  </b></h4> </div>
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
              <p class="card-text"> <b> Price:{{ $product->prize }} Tk. </b>  </p>
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
             <button type="submit" class="acart"><i class="icon-shopping-cart"></i>  Add to Cart </button> 
             </form>
             @endif
          </div>

          </div>
          </div>
          <br><br>

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