<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculeStoreRequest;
use App\Http\Requests\VehiculeUpdateRequest;
use App\Models\Vehicule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehiculeController extends Controller
{
    public function index(Request $request)
    {
        $search = \Request::query('search_keyword');
        
        $vehicules = Vehicule::where(function($q) use ($search){
            if($search){
                $q->where('name','LIKE', '%'.$search.'%')
                    ->orWhere('marque','LIKE', '%'.$search.'%')
                    ->orWhere('matricule','LIKE', '%'.$search.'%');
            }else{
                return Vehicule::all();
            }
        })->latest()->paginate();

        return view('vehicule.index', compact('vehicules'));
    }

    public function create(Request $request)
    {
        return view('vehicule.create');
    }

    public function store(VehiculeStoreRequest $request)
    {
        $vehicule = Vehicule::create($request->validated());
        $request->session()->flash('vehicule.id', $vehicule->id);
        return redirect()->route('vehicule.index');
    }

    public function show(Request $request, Vehicule $vehicule)
    {
        return view('vehicule.show', compact('vehicule'));
    }

    public function edit(Request $request, Vehicule $vehicule)
    {
        return view('vehicule.edit', compact('vehicule'));
    }

    public function update(VehiculeUpdateRequest $request, Vehicule $vehicule)
    {
        $vehicule->update($request->validated());

        $request->session()->flash('vehicule.id', $vehicule->id);

        return redirect()->route('vehicule.index');
    }

    public function destroy(Request $request, Vehicule $vehicule)
    {   
        $vehicule->delete();
        return redirect()->route('vehicule.index');
    }
}
