@extends('layouts.app')

@section('header_title')
    Modification Carburant
@endsection()

@section('content')
    <div class="container">
        <div class="titlebar ">
            <div class="row">
                <h4 class="mb-3">Modifier Carburant</h4>
                <a href="{{ route('carburant.index') }}" class="col-md-1 btn-xs btn-primaryt text text-center">Retour</a>
            </div>
        </div>
        <div class="card mt-4 p-4">
            <form action="{{ route('carburant.update',$carburant->id) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="form-outline mb-4 col-6">
                        <label class="form-label" for="form7Example1">Vehicule</label>
                        <select name="vehicule_id" id="vehicule_id" class="form-control">
                            <option value="" selected>Choisir une Vehicule</option>
                            @foreach ($vehicules as $item)
                                <option {{ $carburant->vehicule_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('vehicule_id')
                            <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Email input -->
                    <div class="form-outline col-6 mb-4">
                        <label class="form-label" for="form7Example2">Littre</label>
                        <input type="number" name="littre" id="littre" class="form-control" value="{{$carburant->littre}}"/>
                        @error('littre')
                            <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!-- Name input -->
                <div class="row">
                    <div class="form-outline mb-4 col-6">
                        <label class="form-label" for="form7Example1">Prix par Littre</label>
                        <input type="text" name="price_per_littre" id="price_per_littre" class="form-control" value="{{$carburant->price_per_littre}}"/>
                        <input type="hidden" id="user_id" name="user_id" class="form-control"
                            value="{{ auth()->user()->id }}" />
                        <input type="hidden" id="date" name="date" class="form-control"
                            value="{{ date('d-m-Y h:i:s') }}" />
                        @error('price_per_littre')
                            <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-outline mb-4 col-6">
                        <label class="form-label" for="form7Example1">Total Prix</label>
                        <input type="text" disabled id="prix_total" class="form-control"
                            value="{{$carburant->price_per_littre * $carburant->littre}}" />
                        <input type="hidden"  name="prix_total" class="prix_total" class="form-control"
                            value="" />
                        @error('prix_total')
                            <span class="text text-danger mt-2 text text-center">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- Name input -->
                <div class="form-group">
                    <button id="KOKO" class="btn btn-sm btn-success">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text text-center text-danger" id="exampleModalLabel">Attention</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary Close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_loader')
    <script>
        $('#price_per_littre').on('keyup', function() {
            if ($('#littre').val() === '') {
                $(this).val('')
                $('#exampleModal').modal('show')
            } else {
                let litter = parseInt($('#littre').val())
                let price_per_littre = parseInt($('#price_per_littre').val())
                let total = litter * price_per_littre;
                $('#prix_total').val(total);
                $('.prix_total').val(total);
            }
        })
        $('.Close').on('click', function() {
            $('#exampleModal').modal('hide')
        })
    </script>
@endpush
