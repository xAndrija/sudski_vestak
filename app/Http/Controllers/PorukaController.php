<?php

namespace App\Http\Controllers;

use App\Models\Poruka;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PorukaController extends Controller
{
    public function index(Request $request): View
    {
        $porukas = Poruka::all();

        return view('poruka.index', compact('porukas'));
    }

    public function create(Request $request): View
    {
        return view('poruka.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Poruka::create($request->all());

        return redirect()->route('porukas.index');
    }

    public function show(Request $request, Poruka $poruka): View
    {
        return view('poruka.show', compact('poruka'));
    }

    public function edit(Request $request, Poruka $poruka): View
    {
        return view('poruka.edit', compact('poruka'));
    }

    public function update(Request $request, Poruka $poruka): RedirectResponse
    {
        $poruka->update($request->all());

        return redirect()->route('porukas.index');
    }

    public function destroy(Request $request, Poruka $poruka): RedirectResponse
    {
        $poruka->delete();

        return redirect()->route('porukas.index');
    }
}
