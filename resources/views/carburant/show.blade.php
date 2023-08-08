
@extends('layouts.app')

@section('header_title')
    Visualiser carburant
@endsection

@section('content')
<div class="container">
    <div class="titlebar">
       <div class="row">
        <h4 class="mb-3 col-md-6">Visualiser carburant</h4>
        <a href="{{route("carburant.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
       </div>
    </div>
    <div class="card mt-4 p-4">
        <p><b>Vehicule:</b> {{$carburant->vehicule->name}}</p>
        <p><b>Litre:</b> {{$carburant->littre}}</p>
        <p><b>Prix Par Litre:</b> {{$carburant->price_per_littre}}</p>
        <p><b>Prix Total:</b> {{$carburant->prix_total}}</p>
        <p><b>Date :</b> {{date('d-m-Y',strtotime($carburant->date))}}</p>
        <p><b>Fait Par:</b> {{$carburant->user->name}}</p>
    </div>
</div>
@endsection

