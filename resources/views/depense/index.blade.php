
@extends('layouts.app')

@section('header_title')
  Listes des Depenses
@endsection
  
@section('content')
    <div class="container">
        <div class="titlebar">
            <h4 class="mb-3">Listes des Depenses</h4>
            <form action="{{route('depense.index')}}">
                <div class="row">
                    <input type="text" class="form-control col-md-5" placeholder="Votre Recherche Ici" name="search_keyword">
                    <h2 class="col-md-1"></h2>
                    <button  type="submit" class="btn btn-sm btn-primary col-md-2">Chercher</button>
                    <h2 class="col-md-1"></h2>
                    <a href="{{route('depense.create')}}" class="btn btn-sm btn-success col-md-1"><i class="fa fa-plus"></i>Nouveau</a>
                </div>
            </form>
        </div>
        <div class="card mt-4">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Vehicule</th>
                    <th scope="col">Piece</th>
                    <th scope="col">Type</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($depenses as $index=> $depense)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$depense->vehicule->name }}</td>
                        <td>{{$depense->piece }}</td>
                        <td>{{$depense->type }}</td>
                        <td>{{$depense->price }}</td>
                        <td>{{$depense->user->name  }}</td>
                        <td>
                          <div class="row">
                            <a href="{{route('depense.show',$depense)}}" class="col-3 btn btn-sm btn-primary"></a>
                            <a href="{{route('depense.edit',$depense)}}" class="col-3 btn btn-sm btn-warning"></a>
                            <form action="{{route('depense.destroy',$depense)}}" method="POST" class="col-3">
                              @csrf
                              @method("DELETE")
                              <button onclick="return confirm('Voulez-vous Confirmer?')" class="btn btn-sm btn-danger"></button>
                            </form>
                          </div>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>  
@endsection

