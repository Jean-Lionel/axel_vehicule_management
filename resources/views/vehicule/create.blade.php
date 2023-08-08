@extends('layouts.app')

@section('header_title')
    Creation Nouveau Voiture
@endsection()

@section('content')
    <div class="container">
        <div class="titlebar ">
            <div class="row">
                <h4 class="mb-3">Creer un Vehicule</h4>
                <a href="{{route("vehicule.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
            </div>
        </div>
        <div class="card mt-4 p-4">
            <form action="{{ route('vehicule.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Nom Voiture:</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                @error('name')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="">Marque:</label>
                    <input type="text" name="marque"  id="" class=" mt-2 text text-center form-control">
                </div>
                @error('marque')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="">Date Achat:</label>   
                    <input type="date" name="date_achat" id="" class="form-control">
                </div>
                @error('date_achat')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="">Matricule:</label>
                    <input type="text" name="matricule" id="" class="form-control">
                </div>
                @error('matricule')
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
