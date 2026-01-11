<?php

namespace App\Http\Controllers;

use App\Http\Requests\PredmetStoreRequest;
use App\Http\Requests\PredmetUpdateRequest;
use App\Models\Predmet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PredmetController extends Controller
{
    public function index(Request $request): View
    {
        $predmets = Predmet::all();

        return view('predmeti', compact('predmets'));
    }

    public function create(Request $request): View
    {
        abort_unless(Gate::allows('predmet.create'), 403);

        return view('predmet.create');
    }

    public function store(PredmetStoreRequest $request): RedirectResponse
    {
        Predmet::create($request->validated());

        return redirect()->route('predmeti');
    }

    public function edit(Request $request, Predmet $predmet): View
    {
        abort_unless(Gate::allows('predmet.update'), 403);

        return view('predmet.edit', compact('predmet'));
    }

    public function update(PredmetUpdateRequest $request, Predmet $predmet): RedirectResponse
    {
        abort_unless(Gate::allows('predmet.update'), 403);

        $predmet->update($request->validated());

        return redirect()->route('predmeti');
    }

    public function destroy(Request $request, Predmet $predmet): RedirectResponse
    {
        abort_unless(Gate::allows('predmet.delete'), 403);

        $predmet->delete();

        return redirect()->route('predmeti');
    }
}
