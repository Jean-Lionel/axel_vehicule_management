<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepenseStoreRequest;
use App\Http\Requests\DepenseUpdateRequest;
use App\Models\Depense;
use App\Models\Vehicule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepenseController extends Controller
{
    public function index(Request $request)
    {
        $search = \Request::query('search_keyword');
        
        $depenses = Depense::where(function($q) use ($search){
            if($search){
                $q->where('piece','LIKE', '%'.$search.'%')
                    ->orWhere('type','LIKE', '%'.$search.'%');
            }else{
                return Depense::all();
            }
        })->latest()->paginate();

        return view('depense.index', compact('depenses'));
    }

    public function create(Request $request)
    {
        $vehicules=Vehicule::all();
        return view('depense.create',compact('vehicules'));
    }

    public function store(DepenseStoreRequest $request)
    {
        $depense = Depense::create($request->validated());

        $request->session()->flash('depense.id', $depense->id);

        return redirect()->route('depense.index');
    }

    public function show(Request $request, Depense $depense)
    {
        return view('depense.show', compact('depense'));
    }

    public function edit(Request $request, Depense $depense)
    {
        $vehicules=Vehicule::all();
        return view('depense.edit', compact('depense','vehicules'));
    }

    public function update(DepenseUpdateRequest $request, Depense $depense)
    {
        $depense->update($request->validated());

        $request->session()->flash('depense.id', $depense->id);

        return redirect()->route('depense.index');
    }

    public function destroy(Request $request, Depense $depense)
    {
        $depense->delete();

        return redirect()->route('depense.index');
    }
}
