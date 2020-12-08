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

          
             <b>   Manage Category </b>
              </div>
              <div class="card-body">
            <table class="table table-hover">
              <tr>
                <td><b>#<b></td>
                <td> <b>Category Title </b> </td>
                <td> <b> Parent Category </b> </td> 
                <td> <b> Edit </b> </td>
                <td> <b> Delete </b> </td>
              </tr>
              @foreach($categories as $category)
              <tr>
                <td>#</td>
                <td> {{ $category->name}} </td>
                 <td> 
                  @if ($category->parent_id == NULL)
                  Primary Category
                 @else 
                      {{ $category->parent->name}}
                 @endif
                   </td>          
                <td> <a href="{{ route('admin.category.edit',$category->id)}}" class="btn btn-info">Edit</a>
                </td>
                <td>

                 <a href="{{ route('admin.category.delete',$category->id)}}" class="btn btn-danger">Delete</a>

               
              
                 
              </td>
              </tr>
          


              @endforeach
            </table>
            </div>
            </div>
        </div>
        </div>

        @endsection