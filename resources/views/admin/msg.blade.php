@extends('admin.layouts.master')
@section('content')
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>

<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">

          
             <b>  Feedback </b>
              </div>
              <div class="card-body">
          
            <table class="table table-hover table-striped">
              <thead>
              <tr>
                <td><b> Serial <b> </td>
                <td><b> First Name <b> </td>
                <td> <b> Last Name </b> </td>
                <td> <b> Email </b> </td>
                <td> <b> Contact NO </b> </td>
                <td> <b> Subject </b> </td>
                <td> <b> Message </b> </td> 
              </tr>
            </thead>
            <div class="n">
              @foreach($ms as $m)
              <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $m->first_Name }}</td>
                <td>{{ $m->last_Name }}</td>
                <td>{{ $m->email }}</td>
                <td>{{ $m->contact_no }}</td>
                <td>{{ $m->subject }}</td>
                <td>
                  <a href="{{ route('message.view',$m->id)}}" class="btn btn-info">View Message</a>
               </td>
              </tr>
               @endforeach
         </div>
         </table>
         </div>


            

            </div> </div>

       
        </div>

 </html>       




@endsection