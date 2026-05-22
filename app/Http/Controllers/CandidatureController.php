<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;

class CandidatureController extends Controller
{
    public function index()
    {
        $candidatures = Candidature::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('candidatures.index', compact('candidatures'));
    }

    public function create()
    {
        return view('candidatures.create');
    }

    public function store(StoreCandidatureRequest $request)
    {
        auth()->user()->candidatures()->create($request->validated());

        return redirect()->route('candidatures.index')
            ->with('success', 'Candidature ajoutée.');
    }

    public function show(Candidature $candidature)
    {
        $this->authorize('view', $candidature);
        $candidature->load('entretiens');

        return view('candidatures.show', compact('candidature'));
    }

    public function edit(Candidature $candidature)
    {
        $this->authorize('update', $candidature);

        return view('candidatures.edit', compact('candidature'));
    }

    public function update(UpdateCandidatureRequest $request, Candidature $candidature)
    {
        $this->authorize('update', $candidature);
        $candidature->update($request->validated());

        return redirect()->route('candidatures.index')
            ->with('success', 'Candidature mise à jour.');
    }

    public function destroy(Candidature $candidature)
    {
        $this->authorize('delete', $candidature);
        $candidature->delete();

        return redirect()->route('candidatures.index')
            ->with('success', 'Candidature supprimée.');
    }
}
