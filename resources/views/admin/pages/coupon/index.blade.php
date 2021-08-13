@extends('admin.layouts.master')
@section('content')




<div class="main-panel">
          <div class="content-wrapper">

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
            <table class="table table-hover">
              <tr>
                <td><b> Coupon Name <b> </td>
                <td> <b> Coupon Code </b> </td>
                <td> <b> Discount </b> </td>
                </tr>
              </thead>
              @foreach($coupons as $coupon)
              <tr>
                <td>{{ $coupon->coupon_name }}</td>
                <td>{{ $coupon->coupon_code}}</td>
                <td>{{ $coupon->discount }} </td>
                
              </tr>
          @endforeach
          
            </table>
            </div>
            </div>
        </div>
        </div>

        @endsection