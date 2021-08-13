@extends('admin.layouts.master')
@section('content')

<div class="main-panel">
          <div class="content-wrapper">

            <div class="card">
              <div class="card-header">
                <h5> Message </h5>
              </div>
              <div class="card-body">
                {{ $ms->message}}
                
               
</div>
</div>
</div>
</div>
@endsection