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
    public function index(Request $request): Response
    {
        $vehicules = Vehicule::all();

        return view('vehicule.index', compact('vehicules'));
    }

    public function create(Request $request): Response
    {
        return view('vehicule.create');
    }

    public function store(VehiculeStoreRequest $request): Response
    {
        $vehicule = Vehicule::create($request->validated());

        $request->session()->flash('vehicule.id', $vehicule->id);

        return redirect()->route('vehicule.index');
    }

    public function show(Request $request, Vehicule $vehicule): Response
    {
        return view('vehicule.show', compact('vehicule'));
    }

    public function edit(Request $request, Vehicule $vehicule): Response
    {
        return view('vehicule.edit', compact('vehicule'));
    }

    public function update(VehiculeUpdateRequest $request, Vehicule $vehicule): Response
    {
        $vehicule->update($request->validated());

        $request->session()->flash('vehicule.id', $vehicule->id);

        return redirect()->route('vehicule.index');
    }

    public function destroy(Request $request, Vehicule $vehicule): Response
    {
        $vehicule->delete();

        return redirect()->route('vehicule.index');
    }
}
