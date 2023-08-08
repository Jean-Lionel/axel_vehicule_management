
@extends('layouts.app')

@section('header_title')
    Visualiser Maintenance 
@endsection

@section('content')
    <div class="container">
        <div class="titlebar">
           <div class="row">
            <h4 class="mb-3 col-md-6">Visualiser Maintenance</h4>
            <a href="{{route("maintenance.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
           </div>
        </div>
        <div class="card mt-4 p-4">
            <p><b>Name:</b> {{$maintenance->name}}</p>
        </div>
    </div>
@endsection

