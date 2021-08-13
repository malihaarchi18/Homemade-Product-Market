
@include('layouts.partial.style')


          <title>Refund Confirm</title>

            <div class="card">
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
                <td> <b> Action</b> </td>
              </tr>
            </thead>
            <div class="n"> @foreach($refund as $r)
              <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $r->order_id }}</td>
                <td>{{ $r->transaction_id }}</td>
                <td>{{ $r->refund }}</td>
                <td> {{ $r->reason }}</td>
                <td> 
                   <button type="button" class="btn btn-danger btn-sm">{{$r->status}}</button>
                </td>
                <td>
                  @if($r->status=='refunded')
         <a href="" class="btn btn-success">✓Refunded</a>
                  @else
                   <a href="{{ route('approve',$r->id)}}" class="btn btn-success">Approve</a>
                   @endif

                </td>
                
               @endforeach
         </div>
         </table>
         </div>


            

            </div> 

       
       

       



       