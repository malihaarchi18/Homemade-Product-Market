@extends('admin.layouts.master')
@section('content')




<div class="main-panel">
        

            <div class="card">
              <div class="card-header">
                @if(session('dltmsg'))
          <div class="alert alert-info" role="alert">

        {{ session('dltmsg') }}

         </div>


           @endif

          
             <b>   Manage Product </b>
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
                <td> <b> Price </b> </td> 
                <td> <b> Quantity </b> </td>
                <td> <b> Edit </b> </td>
                <td> <b> Delete </b> </td>
                
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
                <td>{{ $product->quantity }}</td>
                <td> <a href="{{ route('admin.product.edit',$product->id)}}" class="btn btn-info">Edit</a>
                </td>
                <td>

                 <a href="{{ route('admin.product.delete',$product->id)}}" class="btn btn-danger">Delete</a>
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



       