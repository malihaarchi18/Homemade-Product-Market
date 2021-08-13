@extends('admin.layouts.master')
@section('content')




<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">

          
             <b>  Refunds </b>
              </div>
              <div class="card-body">
          
            <table class="table table-hover table-striped">
              <thead>
              <tr>
                <td><b> Serial <b> </td>
                <td><b> Order Id <b> </td>
                <td> <b> Trasaction ID </b> </td>
                <td> <b> Refund Amount </b> </td>
                <td> <b> Reason</b> </td>
                <td> <b> Status</b> </td>
              </tr>
            </thead>
            <div class="n">
              @foreach($refund as $r)
              <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $r->order_id }}</td>
                <td>{{ $r->transaction_id }}</td>
                <td>{{ $r->refund }}</td>
                <td> {{ $r->reason }}</td>
                <td> 
                     @if($r->status=='refunded')
       <button type="button" class="btn btn-success btn-sm">Refunded</button>
                  @else
                <button type="button" class="btn btn-danger btn-sm">Pending</button>
                   @endif
                    

                </td>
                
               @endforeach
         </div>
         </table>
         </div>


            

            </div> </div>

       
        </div>

        @endsection



       