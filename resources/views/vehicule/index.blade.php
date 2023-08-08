
@extends('layouts.app')

@section('header_title')
  Listes des Vehicules
@endsection
  
@section('content')
    <div class="container">
        <div class="titlebar">
            <h4 class="mb-3">Listes des Vehicules</h4>
            <form action="{{route('vehicule.index')}}">
                <div class="row ml-1">
                    <input type="text" class="form-control col-md-5" placeholder="Votre Recherche Ici" name="search_keyword">
                    <h2 class="col-md-1"></h2>
                    <button  type="submit" class="btn btn-sm btn-primary col-md-1"><i class="bi bi-search"></i>&nbsp;Chercher</button>
                    <h2 class="col-md-1"></h2>
                    <a href="{{route('vehicule.create')}}" class="btn btn-sm btn-success col-md-1"><i class="bi bi-plus-lg"></i>&nbsp;Nouveau</a>
                </div>
            </form>
        </div>
        <div class="card mt-4">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Date Achat</th>
                    <th scope="col">Matricule</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($vehicules as $index=> $item)
                        <tr>
                            <td>
                                {{$index+1}}
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->marque}}</td>
                            <td>{{$item->date_achat}}</td>
                            <td>{{$item->matricule}}</td>
                            <td>
                                <a href="{{route('vehicule.show',$item)}}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>
                                <a href="{{route('vehicule.edit',$item)}}" class="btn btn-sm btn-warning"><i class="bi bi-pen"></i></a>
                                <form action="{{route('vehicule.destroy',$item)}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button onclick="return confirm('Voulez-vous Confirmer?')" class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>  
@endsection

