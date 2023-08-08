div
    @extends('layouts.app')

    @section('header_title')
        Editer le Vehicule
    @endsection

    @section('content')
        <div class="titlebar">
               <div class="row">
                    <h4 class="mb-3 col-md-6">Visualiser un Vehicule</h4>
                    <a href="{{route("vehicule.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
               </div>
        </div>
        <div class="card mt-3 p-4">
            <form method="POST" action="{{route('vehicule.update',$vehicule->id)}}">
                @csrf
                @method('PUT')
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form3Example1">Nom Vehicule</label>
                      <input type="text" id="form3Example1" name="name" class="form-control" value="{{$vehicule->name}}"/>
                    </div>
                    @error('name')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form3Example2">Marque</label>
                      <input type="text" id="form3Example2" name="marque" class="form-control" value="{{$vehicule->marque}}"/>
                    </div>
                    @error('marque')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                     @enderror
                  </div>
                </div>
                <div class="row mb-4">
                <!-- Email input -->
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example3">Date Achat</label>
                            <input type="text" id="form3Example3" name="date_achat" class="form-control" value="{{$vehicule->date_achat}}" />
                        </div>
                        @error('date_achat')
                        <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                    <!-- Password input -->
                        <div class="form-outline">
                            <label class="form-label" for="form3Example4">Matricule</label>
                        <input type="text" id="form3Example4" name="matricule" class="form-control" value="{{$vehicule->matricule}}" />
                        </div>
                        @error('matricule')
                        <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
              
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary col-md-5 mb-4">Modifier</button>
            
              </form>
        </div>

    @endsection

