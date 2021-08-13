@extends('admin.layouts.master')
@section('content')




<div class="main-panel">
        

            <div class="card">

             @if(session('ns'))
            <div class="alert alert-success" role="alert">
            {{ session('ns') }}

            </div>

             @endif
              <div class="card-header">
                @if(session('dltmsg'))
          <div class="alert alert-info" role="alert">

        {{ session('dltmsg') }}

         </div>


           @endif

          
             <b>   Manage sale </b>
              </div>
              <div class="card-body">
          
            <table class="table table-hover table-striped">
              <thead>
              <tr>
                <td><b> Product Id <b> </td>
                <td> <b> Product Title </b> </td>
                <td> <b> Product Image </b> </td>
                <td> <b> Category Name </b> </td>
                <td> <b> Shop Name </b> </td>
                <td> <b> Regular Price </b> </td> 
                <td> <b> Offer Price </b> </td> 
                <td> <b> Sale(%) </b> </td> 
              
                
              </tr>
            </thead>
            <div class="n">
              @foreach($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>
                   @foreach ($product->images as $image)
                
                        <img class="card-img-top feature-img" src="{{ asset('public/img/products/'. $image->image) }}" alt="Card image" >
                  
                  @endforeach
                </td>
                <td>{{ $product->category_name }} </td>
                 <td>{{ $product->shop_name }} </td>
                <td>{{ $product->prize }}</td>
                <td>@if($product->Sale==0)
                N/A
                @else
                      {{$product->prize-($product->Sale/100)*$product->prize}}
                @endif
              </td>
                <td>
                <form action="{{route('sale.price',$product->id)}}" method="post">
        @csrf
    <input type="number" style="width:50px;" name="sale" id="quantity" value="{{ $product->Sale}}"/>
    <button type="submit" class="btn btn-danger btn-xs">Update</button></form>
  </td>
                
                 
              </tr>
          @endforeach
           {{ $products->links()}}
         </div>
         </table>
         </div>


            

            
</div>
     
        </div>

        @endsection



       