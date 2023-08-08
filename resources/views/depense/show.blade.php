
    @extends('layouts.app')

    @section('header_title')
        Visualiser Depense
    @endsection

    @section('content')
    <div class="container">
        <div class="titlebar">
           <div class="row">
            <h4 class="mb-3 col-md-6">Visualiser Depense</h4>
            <a href="{{route("depense.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
           </div>
        </div>
        <div class="card mt-4 p-4">
            <p><b>Vehicule:</b> {{$depense->vehicule->name}}</p>
            <p><b>Piece:</b> {{$depense->piece}}</p>
            <p><b>Type:</b> {{$depense->type}}</p>
            <p><b>Price :</b> {{$depense->price}}</p>
            <p><b>Fait par:</b> {{$depense->user->name}}</p>
        </div>
    </div>
    @endsection

