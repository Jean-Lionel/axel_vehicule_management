@extends('layouts.app')

@section('header_title')
    Modifier Entretien
@endsection()

@section('content')
    <div class="container">
        <div class="titlebar ">
            <div class="row">
                <h4 class="mb-3">Modifier Entretien</h4>
                <a href="{{route("entretien.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
            </div>
        </div>
        <div class="card mt-4 p-4">
            <form action="{{ route('entretien.update',$entretien->id) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="">Vehicule:</label>
                    <select name="vehicule_id" id="vehicule_id" class="form-control">
                        <option value="" selected>Choisissez une Voiture</option>
                        @foreach ($vehicules as $item)
                        <option {{$entretien->vehicule_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('vehicule_id')
                <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="">Maintenance:</label>
                    <select name="maintenance_id" id="maintenance_id" class="form-control">
                        <option value="" selected>Choisissez une Maintenance</option>
                        @foreach ($maintenances as $item)
                        <option {{$entretien->maintenance_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('maintenance_id')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="">Description:</label>   
                    <textarea name="description" id="description" class="form-control">{{$entretien->description}}</textarea>
                </div>
                @error('description')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="">Montant:</label>
                    <input type="number" name="montant" id="montant" class="form-control" value="{{$entretien->montant}}">
                    
                    {{-- <input type="hidden" name="date" id="date" class="form-control" value={{date('d-m-Y h:i:s')}}>
                     --}}
                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{auth()->user()->id}}">
                </div>
                @error('montant')
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
