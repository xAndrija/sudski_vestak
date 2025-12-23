<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokumentStoreRequest;
use App\Http\Requests\DokumentUpdateRequest;
use App\Models\Dokument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DokumentController extends Controller
{
    public function index(Request $request): View
    {
        $dokuments = Dokument::all();

        return view('dokument.index', [
            'dokuments' => $dokuments,
        ]);
    }

    public function create(Request $request): View
    {
        return view('dokument.create');
    }

    public function store(DokumentStoreRequest $request): RedirectResponse
    {
        $dokument = Dokument::create($request->validated());

        $request->session()->flash('dokument.id', $dokument->id);

        return redirect()->route('dokuments.index');
    }

    public function show(Request $request, Dokument $dokument): View
    {
        return view('dokument.show', [
            'dokument' => $dokument,
        ]);
    }

    public function edit(Request $request, Dokument $dokument): View
    {
        return view('dokument.edit', [
            'dokument' => $dokument,
        ]);
    }

    public function update(DokumentUpdateRequest $request, Dokument $dokument): RedirectResponse
    {
        $dokument->update($request->validated());

        $request->session()->flash('dokument.id', $dokument->id);

        return redirect()->route('dokuments.index');
    }

    public function destroy(Request $request, Dokument $dokument): RedirectResponse
    {
        $dokument->delete();

        return redirect()->route('dokuments.index');
    }
}
