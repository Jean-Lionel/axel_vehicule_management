@extends('layouts.app')

@section('header_title')
    Creation Maintance
@endsection()

@section('content')
    <div class="container">
        <div class="titlebar ">
            <div class="row">
                <h4 class="mb-3">Creer Maintenance</h4>
                <a href="{{route("maintenance.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
            </div>
        </div>
        <div class="card mt-4 p-4">
            <form action="{{ route('maintenance.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Nom Maintenace:</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                @error('name')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <button class="btn btn-sm btn-success">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
