@extends('admin.layouts.master')
@section('content')




<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">
                @if(session('msg'))
          <div class="alert alert-success" role="alert">

        {{ session('msg') }}

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
                <td> <b> Customer Name </b> </td>
                <td> <b> Contact No. </b> </td>
                <td> <b> Order Status</b>
                 </td>
                <td> <b> Seen/Unseen</b> </td>
                <td> <b> Actions </b> </td>
              </tr>
            </thead>

            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>Order No.{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone }} </td>
              <td> 
                 {{$order->status}}
                 
                 </select>
     </td> 
                <td>
                     @if($order->seen_by_admin=='YES')
                     <button type="button" style="background-color:##2196f3;;"class="btn btn-primary btn-sm">Seen</button>
                     @else
                      <button type="button" class="btn btn-warning btn-sm">Unseen</button>
                      @endif
                
                </td>
                <td>
              <a href="{{ route('admin.orders.view',$order->id)}}" class="btn btn-info">View</a>
               <a href="{{ route('admin.orders.delete',$order->id)}}" class="btn btn-danger">Delete</a>

               @if($order->status=='Delivered')
              
                <a href="{{ route('admin.orders.delivaryview',$order->id)}}" class="btn btn-success">View Delivary Details</a>
                @else

                <a style="background-color:#fd7e14;" href="" class="btn btn-warning">Not Delivered Yet</a>
                @endif
               </td>
              </tr>
              @endforeach
               {{ $orders->links() }}
              



               
              
                 
              
          


              
            </tbody>

            </table>

            </div>
            </div>
        </div>
        </div>

        @endsection




        