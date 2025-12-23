<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzvestajStoreRequest;
use App\Http\Requests\IzvestajUpdateRequest;
use App\Models\Izvestaj;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IzvestajController extends Controller
{
    public function index(Request $request): View
    {
        $izvestajs = Izvestaj::all();

        return view('izvestaj.index', [
            'izvestajs' => $izvestajs,
        ]);
    }

    public function create(Request $request): View
    {
        return view('izvestaj.create');
    }

    public function store(IzvestajStoreRequest $request): RedirectResponse
    {
        $izvestaj = Izvestaj::create($request->validated());

        $request->session()->flash('izvestaj.id', $izvestaj->id);

        return redirect()->route('izvestajs.index');
    }

    public function show(Request $request, Izvestaj $izvestaj): View
    {
        return view('izvestaj.show', [
            'izvestaj' => $izvestaj,
        ]);
    }

    public function edit(Request $request, Izvestaj $izvestaj): View
    {
        return view('izvestaj.edit', [
            'izvestaj' => $izvestaj,
        ]);
    }

    public function update(IzvestajUpdateRequest $request, Izvestaj $izvestaj): RedirectResponse
    {
        $izvestaj->update($request->validated());

        $request->session()->flash('izvestaj.id', $izvestaj->id);

        return redirect()->route('izvestajs.index');
    }

    public function destroy(Request $request, Izvestaj $izvestaj): RedirectResponse
    {
        $izvestaj->delete();

        return redirect()->route('izvestajs.index');
    }
}
