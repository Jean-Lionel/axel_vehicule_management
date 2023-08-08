div
@extends('layouts.app')

@section('header_title')
    Editer le Depense
@endsection

@section('content')
    <div class="titlebar">
        <div class="row">
            <h4 class="mb-3 col-md-6">Modifier Depense</h4>
            <a href="{{ route('depense.index') }}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
        </div>
    </div>
    <div class="card mt-3 p-4">
        <form method="POST" action="{{ route('depense.update', $depense->id) }}">
            @csrf
            @method('PUT')
            <!-- 2 column grid layout with text inputs for the first and last names -->

            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">Vehicule</label>
                        {{-- <input type="text" id="vehicule_id" name="vehicule_id" class="form-control" /> --}}
                        <select name="vehicule_id" id="vehicule_id" class="form-control">
                            <option value="" selected>Choisir Voiture</option>
                            @foreach ($vehicules as $index => $vehicule)
                                <option {{$depense->vehicule_id  == $vehicule->id ? 'selected' : ''}} value="{{ $vehicule->id }}">{{ $vehicule->name }}</option>
                            @endforeach
                        </select>
                        @error('vehicule_id')
                            <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example2">Piece</label>
                        <input type="text" id="piece" name="piece" class="form-control" value="{{$depense->piece}}"/>
                    </div>
                    @error('piece')
                        <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form6Example2">Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text text-primary">$</div>
                    </div>
                    <input type="number" class="form-control" id="price" name="price" placeholder="20" value="{{$depense->price}}">
                </div>
                @error('price')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                @enderror
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form6Example3">Type</label>
                <input type="text" id="type" value="{{$depense->type}}" name="type" class="form-control" />
                <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{ auth()->user()->id }}" />
            </div>
            @error('type')
                <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
            @enderror
            @error('user_id')
                <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
            @enderror
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary col-md-5 mb-4">Modifier</button>

        </form>
    </div>
@endsection
