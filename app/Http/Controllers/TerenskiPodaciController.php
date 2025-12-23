<?php

namespace App\Http\Controllers;

use App\Http\Requests\TerenskiPodaciStoreRequest;
use App\Http\Requests\TerenskiPodaciUpdateRequest;
use App\Models\TerenskiPodaci;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TerenskiPodaciController extends Controller
{
    public function index(Request $request): View
    {
        $terenskiPodacis = TerenskiPodaci::all();

        return view('terenskiPodaci.index', [
            'terenskiPodacis' => $terenskiPodacis,
        ]);
    }

    public function create(Request $request): View
    {
        return view('terenskiPodaci.create');
    }

    public function store(TerenskiPodaciStoreRequest $request): RedirectResponse
    {
        $terenskiPodaci = TerenskiPodaci::create($request->validated());

        $request->session()->flash('terenskiPodaci.id', $terenskiPodaci->id);

        return redirect()->route('terenskiPodacis.index');
    }

    public function show(Request $request, TerenskiPodaci $terenskiPodaci): View
    {
        return view('terenskiPodaci.show', [
            'terenskiPodaci' => $terenskiPodaci,
        ]);
    }

    public function edit(Request $request, TerenskiPodaci $terenskiPodaci): View
    {
        return view('terenskiPodaci.edit', [
            'terenskiPodaci' => $terenskiPodaci,
        ]);
    }

    public function update(TerenskiPodaciUpdateRequest $request, TerenskiPodaci $terenskiPodaci): RedirectResponse
    {
        $terenskiPodaci->update($request->validated());

        $request->session()->flash('terenskiPodaci.id', $terenskiPodaci->id);

        return redirect()->route('terenskiPodacis.index');
    }

    public function destroy(Request $request, TerenskiPodaci $terenskiPodaci): RedirectResponse
    {
        $terenskiPodaci->delete();

        return redirect()->route('terenskiPodacis.index');
    }
}
