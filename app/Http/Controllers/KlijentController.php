<?php

namespace App\Http\Controllers;

use App\Http\Requests\KlijentStoreRequest;
use App\Http\Requests\KlijentUpdateRequest;
use App\Models\Klijent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KlijentController extends Controller
{
    public function index(Request $request): View
    {
        $klijents = Klijent::all();

        return view('klijent.index', [
            'klijents' => $klijents,
        ]);
    }

    public function create(Request $request): View
    {
        return view('klijent.create');
    }

    public function store(KlijentStoreRequest $request): RedirectResponse
    {
        $klijent = Klijent::create($request->validated());

        $request->session()->flash('klijent.id', $klijent->id);

        return redirect()->route('klijents.index');
    }

    public function show(Request $request, Klijent $klijent): View
    {
        return view('klijent.show', [
            'klijent' => $klijent,
        ]);
    }

    public function edit(Request $request, Klijent $klijent): View
    {
        return view('klijent.edit', [
            'klijent' => $klijent,
        ]);
    }

    public function update(KlijentUpdateRequest $request, Klijent $klijent): RedirectResponse
    {
        $klijent->update($request->validated());

        $request->session()->flash('klijent.id', $klijent->id);

        return redirect()->route('klijents.index');
    }

    public function destroy(Request $request, Klijent $klijent): RedirectResponse
    {
        $klijent->delete();

        return redirect()->route('klijents.index');
    }
}
