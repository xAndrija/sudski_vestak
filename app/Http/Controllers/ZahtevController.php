<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZahtevStoreRequest;
use App\Http\Requests\ZahtevUpdateRequest;
use App\Models\Klijent;
use App\Models\Zahtev;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ZahtevController extends Controller
{
    public function index(Request $request): View
    {
        $zahtevs = Zahtev::all();

        return view('zahtevi', compact('zahtevs'));
    }

    public function create(Request $request): View
    {
        abort_unless(Gate::allows('zahtev.create'), 403);

        $klijents = Klijent::all();

        return view('zahtev.create', compact('klijents'));
    }

    public function store(ZahtevStoreRequest $request): RedirectResponse
    {
        $zahtev = Zahtev::create($request->validated());

        $request->session()->flash('zahtev.id', $zahtev->id);

        return redirect()->route('zahtevi');
    }

    public function show(Request $request, Zahtev $zahtev): View
    {
        return view('zahtev.show', [
            'zahtev' => $zahtev,
        ]);
    }

    public function edit(Request $request, Zahtev $zahtev): View
    {
        abort_unless(Gate::allows('zahtev.update'), 403);

        $klijents = Klijent::all();

        return view('zahtev.edit', compact('zahtev', 'klijents'));
    }

    public function update(ZahtevUpdateRequest $request, Zahtev $zahtev): RedirectResponse
    {
        abort_unless(Gate::allows('zahtev.update'), 403);

        $zahtev->update($request->validated());

        $request->session()->flash('zahtev.id', $zahtev->id);

        return redirect()->route('zahtevi');
    }

    public function destroy(Request $request, Zahtev $zahtev): RedirectResponse
    {
        abort_unless(Gate::allows('zahtev.delete'), 403);

        $zahtev->delete();

        return redirect()->route('zahtevi');
    }
}
