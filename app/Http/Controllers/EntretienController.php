<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntretienStoreRequest;
use App\Http\Requests\EntretienUpdateRequest;
use App\Models\Entretien;
use App\Models\Maintenance;
use App\Models\Vehicule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EntretienController extends Controller
{
    public function index(Request $request)
    {
        $entretiens = Entretien::all();

        return view('entretien.index', compact('entretiens'));
    }

    public function create(Request $request)
    {
        $vehicules=Vehicule::all();
        $maintenances=Maintenance::all();
        return view('entretien.create',compact('vehicules','maintenances'));
    }

    public function store(EntretienStoreRequest $request)
    {
        $entretien = Entretien::create($request->validated());

        $request->session()->flash('entretien.id', $entretien->id);

        return redirect()->route('entretien.index');
    }

    public function show(Request $request, Entretien $entretien)
    {
        return view('entretien.show', compact('entretien'));
    }

    public function edit(Request $request, Entretien $entretien)
    {
        $vehicules=Vehicule::all();
        $maintenances=Maintenance::all();
        return view('entretien.edit', compact('entretien','vehicules','maintenances'));
    }

    public function update(EntretienUpdateRequest $request, Entretien $entretien)
    {
        $entretien->update($request->validated());

        $request->session()->flash('entretien.id', $entretien->id);

        return redirect()->route('entretien.index');
    }

    public function destroy(Request $request, Entretien $entretien)
    {
        $entretien->delete();

        return redirect()->route('entretien.index');
    }
}
