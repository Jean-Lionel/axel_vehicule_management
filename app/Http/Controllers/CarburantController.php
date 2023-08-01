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
    public function index(Request $request): Response
    {
        $carburants = Carburant::all();

        return view('carburant.index', compact('carburants'));
    }

    public function create(Request $request): Response
    {
        return view('carburant.create');
    }

    public function store(CarburantStoreRequest $request): Response
    {
        $carburant = Carburant::create($request->validated());

        $request->session()->flash('carburant.id', $carburant->id);

        return redirect()->route('carburant.index');
    }

    public function show(Request $request, Carburant $carburant): Response
    {
        return view('carburant.show', compact('carburant'));
    }

    public function edit(Request $request, Carburant $carburant): Response
    {
        return view('carburant.edit', compact('carburant'));
    }

    public function update(CarburantUpdateRequest $request, Carburant $carburant): Response
    {
        $carburant->update($request->validated());

        $request->session()->flash('carburant.id', $carburant->id);

        return redirect()->route('carburant.index');
    }

    public function destroy(Request $request, Carburant $carburant): Response
    {
        $carburant->delete();

        return redirect()->route('carburant.index');
    }
}
