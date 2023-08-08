
@extends('layouts.app')

@section('header_title')
  Listes des Entretiens
@endsection
  
@section('content')
    <div class="container">
        <div class="titlebar">
            <h4 class="mb-3">Listes des Entretiens</h4>
            <form action="{{route('entretien.index')}}">
                <div class="row ml-1">
                    <input type="text" class="form-control col-md-5" placeholder="Votre Recherche Ici" name="search_keyword">
                    <h2 class="col-md-1"></h2>
                    <button  type="submit" class="btn btn-sm btn-primary col-md-2">Chercher</button>
                    <h2 class="col-md-1"></h2>
                    <a href="{{route('entretien.create')}}" class="btn btn-sm btn-success col-md-1"><i class="fa fa-plus"></i>Nouveau</a>
                </div>
            </form>
        </div>
        <div class="card mt-4">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Vehicule</th>
                    <th scope="col">Maintenance</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Fait par</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($entretiens as $index=> $item)
                        <tr>
                            <td>
                                {{$index+1}}
                            </td>
                            <td>{{$item->vehicule->name}}</td>
                            <td>{{$item->maintenance->name}}</td>
                            <td data-toggle="tooltip" data-placement="left">{{substr($item->description,0,20)."..."}}</td>
                            <td>{{date('d-m-Y',strtotime($item->date))}}</td>
                            <td>{{$item->montant}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>
                                <a href="{{route('entretien.show',$item)}}" class="btn btn-sm btn-primary"></a>
                                <a href="{{route('entretien.edit',$item)}}" class="btn btn-sm btn-warning"></a>
                                <form action="{{route('entretien.destroy',$item)}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button onclick="return confirm('Voulez-vous Confirmer?')" class="btn btn-sm btn-danger"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>  
@endsection

