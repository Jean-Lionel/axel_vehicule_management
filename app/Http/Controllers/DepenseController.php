<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepenseStoreRequest;
use App\Http\Requests\DepenseUpdateRequest;
use App\Models\Depense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepenseController extends Controller
{
    public function index(Request $request)
    {
        $depenses = Depense::all();

        return view('depense.index', compact('depenses'));
    }

    public function create(Request $request)
    {
        return view('depense.create');
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
        return view('depense.edit', compact('depense'));
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
