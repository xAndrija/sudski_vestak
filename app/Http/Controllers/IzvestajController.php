<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzvestajStoreRequest;
use App\Http\Requests\IzvestajUpdateRequest;
use App\Models\Izvestaj;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class IzvestajController extends Controller
{
    public function index(Request $request): View
    {
        $izvestajs = Izvestaj::all();

        return view('izvestaji', compact('izvestajs'));
    }

    public function create(Request $request): View
    {
        abort_unless(Gate::allows('izvestaj.create'), 403);

        return view('izvestaj.create');
    }

    public function store(IzvestajStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['korisnik_id'] = auth()->id();

        $izvestaj = Izvestaj::create($data);

        $request->session()->flash('izvestaj.id', $izvestaj->id);

        return redirect()->route('izvestaji');
    }

    public function show(Request $request, Izvestaj $izvestaj): View
    {
        return view('izvestaj.show', [
            'izvestaj' => $izvestaj,
        ]);
    }

    public function edit(Request $request, Izvestaj $izvestaj): View
    {
        abort_unless(Gate::allows('izvestaj.update'), 403);

        return view('izvestaj.edit', [
            'izvestaj' => $izvestaj,
        ]);
    }

    public function update(IzvestajUpdateRequest $request, Izvestaj $izvestaj): RedirectResponse
    {
        abort_unless(Gate::allows('izvestaj.update'), 403);

        $data = $request->validated();
        $data['korisnik_id'] = auth()->id();

        $izvestaj->update($data);

        $request->session()->flash('izvestaj.id', $izvestaj->id);

        return redirect()->route('izvestaji');
    }

    public function destroy(Request $request, Izvestaj $izvestaj): RedirectResponse
    {
        abort_unless(Gate::allows('izvestaj.delete'), 403);

        $izvestaj->delete();

        return redirect()->route('izvestaji');
    }
}
