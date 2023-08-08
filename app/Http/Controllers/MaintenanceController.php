<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceStoreRequest;
use App\Http\Requests\MaintenanceUpdateRequest;
use App\Models\Maintenance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $search = \Request::query('search_keyword');
        
        $maintenances = Maintenance::where(function($q) use ($search){
            if($search){
                $q->where('name','LIKE', '%'.$search.'%');
            }else{
                return Maintenance::all();
            }
        })->latest()->paginate();

        return view('maintenance.index', compact('maintenances'));
    }

    public function create(Request $request)
    {
        return view('maintenance.create');
    }

    public function store(MaintenanceStoreRequest $request)
    {
        $maintenance = Maintenance::create($request->validated());

        $request->session()->flash('maintenance.id', $maintenance->id);

        return redirect()->route('maintenance.index');
    }

    public function show(Request $request, Maintenance $maintenance)
    {
        return view('maintenance.show', compact('maintenance'));
    }

    public function edit(Request $request, Maintenance $maintenance)
    {
        return view('maintenance.edit', compact('maintenance'));
    }

    public function update(MaintenanceUpdateRequest $request, Maintenance $maintenance)
    {
        $maintenance->update($request->validated());

        $request->session()->flash('maintenance.id', $maintenance->id);

        return redirect()->route('maintenance.index');
    }

    public function destroy(Request $request, Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenance.index');
    }
}
