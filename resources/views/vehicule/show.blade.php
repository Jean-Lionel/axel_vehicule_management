
    @extends('layouts.app')

    @section('header_title')
        Visualiser Vehicule 
    @endsection
    
    @section('content')
        <div class="container">
            <div class="titlebar">
               <div class="row">
                <h4 class="mb-3 col-md-6">Visualiser un Vehicule</h4>
                <a href="{{route("vehicule.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
               </div>
            </div>
            <div class="card mt-4 p-4">
                <p><b>Name:</b> {{$vehicule->name}}</p>
                <p><b>Matricule:</b> {{$vehicule->matricule}}</p>
                <p><b>Marque:</b> {{$vehicule->marque}}</p>
                <p><b>Date Achat:</b> {{$vehicule->date_achat}}</p>
            </div>
        </div>
    @endsection

