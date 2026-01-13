<?php

namespace App\Http\Controllers;

use App\Http\Requests\TerenskiPodaciStoreRequest;
use App\Http\Requests\TerenskiPodaciUpdateRequest;
use App\Models\TerenskiPodaci;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        abort_unless(Gate::allows('terenskiPodaci.create'), 403);

        return view('terenskiPodaci.create');
    }

    public function store(TerenskiPodaciStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $paths = [];
        foreach (($data['fotografije'] ?? []) as $file) {
            $paths[] = $file->store('terenski_podaci', 'public');
        }

        $data['fotografije'] = json_encode($paths);

        $terenskiPodaci = TerenskiPodaci::create($data);

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
        abort_unless(Gate::allows('terenskiPodaci.update'), 403);

        return view('terenskiPodaci.edit', [
            'terenskiPodaci' => $terenskiPodaci,
        ]);
    }

    public function update(TerenskiPodaciUpdateRequest $request, TerenskiPodaci $terenskiPodaci): RedirectResponse
    {
        abort_unless(Gate::allows('terenskiPodaci.update'), 403);

        $data = $request->validated();

        $paths = [];
        foreach (($data['fotografije'] ?? []) as $file) {
            $paths[] = $file->store('terenski_podaci', 'public');
        }

        $data['fotografije'] = json_encode($paths);

        $terenskiPodaci->update($data);

        $request->session()->flash('terenskiPodaci.id', $terenskiPodaci->id);

        return redirect()->route('terenskiPodacis.index');
    }

    public function destroy(Request $request, TerenskiPodaci $terenskiPodaci): RedirectResponse
    {
        abort_unless(Gate::allows('terenskiPodaci.delete'), 403);

        $terenskiPodaci->delete();

        return redirect()->route('terenskiPodacis.index');
    }
}
