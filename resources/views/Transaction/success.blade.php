@extends('layouts.homepage')

@section('content')

@if(session('a'))
            <div class="alert alert-success" role="alert">
            {{ session('a') }}

            </div>

             @endif
@if(session('e'))
            <div class="alert alert-success" role="alert">
            {{ session('e') }}

            </div>

             @endif





@include('layouts.partial.footer')
@endsection