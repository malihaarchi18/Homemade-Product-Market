@extends('layouts.homepage')

@section('content')

@if(session('b'))
            <div class="alert alert-danger" role="alert">
            {{ session('b') }}

            </div>

             @endif
@if(session('c'))
            <div class="alert alert-danger" role="alert">
            {{ session('c') }}

            </div>

             @endif
@if(session('d'))
            <div class="alert alert-danger" role="alert">
            {{ session('d') }}

            </div>

             @endif
@if(session('f'))
            <div class="alert alert-danger" role="alert">
            {{ session('f') }}

            </div>

             @endif
@if(session('g'))
            <div class="alert alert-danger" role="alert">
            {{ session('g') }}

            </div>

             @endif







@include('layouts.partial.footer')
@endsection