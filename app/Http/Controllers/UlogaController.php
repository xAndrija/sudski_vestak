<?php

namespace App\Http\Controllers;

use App\Http\Requests\UlogaStoreRequest;
use App\Http\Requests\UlogaUpdateRequest;
use App\Models\Uloga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UlogaController extends Controller
{
    public function index(Request $request): View
    {
        $ulogas = Uloga::all();

        return view('uloga.index', [
            'ulogas' => $ulogas,
        ]);
    }

    public function create(Request $request): View
    {
        return view('uloga.create');
    }

    public function store(UlogaStoreRequest $request): RedirectResponse
    {
        $uloga = Uloga::create($request->validated());

        $request->session()->flash('uloga.id', $uloga->id);

        return redirect()->route('ulogas.index');
    }

    public function show(Request $request, Uloga $uloga): View
    {
        return view('uloga.show', [
            'uloga' => $uloga,
        ]);
    }

    public function edit(Request $request, Uloga $uloga): View
    {
        return view('uloga.edit', [
            'uloga' => $uloga,
        ]);
    }

    public function update(UlogaUpdateRequest $request, Uloga $uloga): RedirectResponse
    {
        $uloga->update($request->validated());

        $request->session()->flash('uloga.id', $uloga->id);

        return redirect()->route('ulogas.index');
    }

    public function destroy(Request $request, Uloga $uloga): RedirectResponse
    {
        $uloga->delete();

        return redirect()->route('ulogas.index');
    }
}
