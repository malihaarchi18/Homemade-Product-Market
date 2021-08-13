@extends('delivary.index')
@section('content')




<div class="main-panel">
          

            <div class="card">
              <div class="card-header">
               
                @if(session('d'))
          <div class="alert alert-success" role="alert">

        {{ session('d') }}

         </div>
@endif
 @if(session('n'))
          <div class="alert alert-success" role="alert">

        {{ session('n') }}

         </div>


           @endif
          
             <b>   Manage Orders </b>
              </div>
              <div class="card-body">
            <table class="table table-hover table-striped">
              <thead>
              <tr>
                  <td><b>Serial <b> </td>
                <td><b> Order Id <b> </td>
                <td> <b> Order Status </b> </td>
                <td> <b> Delivered By </b> </td>
                <td> <b> Delivery Date</b>
                 </td>
                <td> <b> Signature Picture </b> </td>
                <td> <b> Actions </b> </td>
              </tr>
            </thead>
              <tbody>
              @foreach($xs as $x)
              <tr>
                <td>{{ $loop->index+1 }}</td>

              <td> <a href="{{ route('delivary.orders.view',$x->order_id)}}"> <u>Order No.{{ $x->order_id }} </u></a> </td>
              <td> {{ $x->status}} </td>
             
                <td>
                   @if( is_null($x->delivered_by))
                   N/A
                  @else
                  {{ $x->delivered_by}}
                  @endif
                </td>

                <td>
                   @if( is_null($x->delivary_time))
                   N/A
                  @else
                  {{ $x->delivary_time}}
                  @endif
                </td>
                <td>
                  @if( is_null($x->image))
                   N/A
                  @else
                    <img class="card-img-top feature-img" src="{{ asset('public/img/products/'. $x->image) }}" alt="Card image" >
                  @endif
              
               <form action="{{ route('delivary.save',$x->order_id)}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
                <td> <select class="form-group" name="status">
      <option value="On the way"><b>On the Way</b></option>
       <option value="To the Delivery Man"><b>To the Delivery Man</b></option>
        <option value="Customer Not Found">Customer Not Found</option>
         <option value="Delivered">Delivered</option>
    </select> <button type="submit" class="btn btn-primary">Save</button>
      <a href="{{route('delivary.edit',$x->order_id)}}" class="btn btn-danger">Add✚</a>
  </td>
                   
                  </form>
                
                
                 
                </td>
                
                  
                </tr>
              
              @endforeach
               
              



               
              
                 
              
          


              
            </tbody>


           
            </table>

            </div>
            </div>
        </div>
        

        @endsection




        