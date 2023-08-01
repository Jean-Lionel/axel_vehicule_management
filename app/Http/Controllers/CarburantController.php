<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarburantStoreRequest;
use App\Http\Requests\CarburantUpdateRequest;
use App\Models\Carburant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarburantController extends Controller
{
    public function index(Request $request)
    {
        $carburants = Carburant::all();

        return view('carburant.index', compact('carburants'));
    }

    public function create(Request $request)
    {
        return view('carburant.create');
    }

    public function store(CarburantStoreRequest $request)
    {
        $carburant = Carburant::create($request->validated());

        $request->session()->flash('carburant.id', $carburant->id);

        return redirect()->route('carburant.index');
    }

    public function show(Request $request, Carburant $carburant)
    {
        return view('carburant.show', compact('carburant'));
    }

    public function edit(Request $request, Carburant $carburant)
    {
        return view('carburant.edit', compact('carburant'));
    }

    public function update(CarburantUpdateRequest $request, Carburant $carburant)
    {
        $carburant->update($request->validated());

        $request->session()->flash('carburant.id', $carburant->id);

        return redirect()->route('carburant.index');
    }

    public function destroy(Request $request, Carburant $carburant)
    {
        $carburant->delete();

        return redirect()->route('carburant.index');
    }
}
