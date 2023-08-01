<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntretienStoreRequest;
use App\Http\Requests\EntretienUpdateRequest;
use App\Models\Entretien;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EntretienController extends Controller
{
    public function index(Request $request): Response
    {
        $entretiens = Entretien::all();

        return view('entretien.index', compact('entretiens'));
    }

    public function create(Request $request): Response
    {
        return view('entretien.create');
    }

    public function store(EntretienStoreRequest $request): Response
    {
        $entretien = Entretien::create($request->validated());

        $request->session()->flash('entretien.id', $entretien->id);

        return redirect()->route('entretien.index');
    }

    public function show(Request $request, Entretien $entretien): Response
    {
        return view('entretien.show', compact('entretien'));
    }

    public function edit(Request $request, Entretien $entretien): Response
    {
        return view('entretien.edit', compact('entretien'));
    }

    public function update(EntretienUpdateRequest $request, Entretien $entretien): Response
    {
        $entretien->update($request->validated());

        $request->session()->flash('entretien.id', $entretien->id);

        return redirect()->route('entretien.index');
    }

    public function destroy(Request $request, Entretien $entretien): Response
    {
        $entretien->delete();

        return redirect()->route('entretien.index');
    }
}
