div
    @extends('layouts.app')

    @section('header_title')
        Editer le Maintenance
    @endsection

    @section('content')
        <div class="titlebar">
               <div class="row">
                    <h4 class="mb-3 col-md-6">Modifier un Maintenance</h4>
                    <a href="{{route("maintenance.index")}}" class="col-md-1 btn-xs btn-primaryt text text-center">Back</a>
               </div>
        </div>
        <div class="card mt-3 p-4">
            <form method="POST" action="{{route('maintenance.update',$maintenance->id)}}">
                @csrf
                @method('PUT')
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form3Example1">Nom Maintenance</label>
                      <input type="text" id="form3Example1" name="name" class="form-control" value="{{$maintenance->name}}"/>
                    </div>
                    @error('name')
                    <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                    @enderror
                  </div>
                 </div>
                              
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary col-md-5 mb-4">Modifier</button>
            
              </form>
        </div>

    @endsection

