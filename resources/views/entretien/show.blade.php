
@extends('layouts.app')

@section('header_title')
    Visualiser Entretiens
@endsection

@section('content')
<div class="container">
    <div class="titlebar">
       <div class="row">
        <h4 class="mb-3 col-md-6">Visualiser Entretiens</h4>
        <a href="{{route("entretien.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
       </div>
    </div>
    <div class="card mt-4 p-4">
        <p><b>Vehicule:</b> {{$entretien->vehicule->name}}</p>
        <p><b>Maintenance:</b> {{$entretien->maintenance->name}}</p>
        <p><b>Description:</b> {{$entretien->description}}</p>
        <p><b>Date :</b> {{date('d-m-Y',strtotime($entretien->date))}}</p>
        <p><b>Montant :</b> {{$entretien->montant}}</p>
        <p><b>Fait par:</b> {{$entretien->user->name}}</p>
    </div>
</div>
@endsection

