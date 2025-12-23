<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZahtevStoreRequest;
use App\Http\Requests\ZahtevUpdateRequest;
use App\Models\Zahtev;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ZahtevController extends Controller
{
    public function index(Request $request): View
    {
        $zahtevs = Zahtev::all();

        return view('zahtev.index', [
            'zahtevs' => $zahtevs,
        ]);
    }

    public function create(Request $request): View
    {
        return view('zahtev.create');
    }

    public function store(ZahtevStoreRequest $request): RedirectResponse
    {
        $zahtev = Zahtev::create($request->validated());

        $request->session()->flash('zahtev.id', $zahtev->id);

        return redirect()->route('zahtevs.index');
    }

    public function show(Request $request, Zahtev $zahtev): View
    {
        return view('zahtev.show', [
            'zahtev' => $zahtev,
        ]);
    }

    public function edit(Request $request, Zahtev $zahtev): View
    {
        return view('zahtev.edit', [
            'zahtev' => $zahtev,
        ]);
    }

    public function update(ZahtevUpdateRequest $request, Zahtev $zahtev): RedirectResponse
    {
        $zahtev->update($request->validated());

        $request->session()->flash('zahtev.id', $zahtev->id);

        return redirect()->route('zahtevs.index');
    }

    public function destroy(Request $request, Zahtev $zahtev): RedirectResponse
    {
        $zahtev->delete();

        return redirect()->route('zahtevs.index');
    }
}
