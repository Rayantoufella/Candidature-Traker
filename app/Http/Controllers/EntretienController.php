<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Entretien;
use App\Http\Requests\StoreEntretienRequest;
use App\Http\Requests\UpdateEntretienRequest;

class EntretienController extends Controller
{
    public function index(Candidature $candidature)
    {
        $entretiens = $candidature->entretiens()->latest()->get();

        return view('entretiens.index', compact('candidature', 'entretiens'));
    }

    public function create(Candidature $candidature)
    {
        return view('entretiens.create', compact('candidature'));
    }

    public function store(StoreEntretienRequest $request, Candidature $candidature)
    {
        $candidature->entretiens()->create($request->validated());

        return redirect()->route('candidatures.entretiens.index', $candidature)
            ->with('success', 'Entretien ajouté.');
    }

    public function show(Candidature $candidature, Entretien $entretien)
    {
        return view('entretiens.show', compact('candidature', 'entretien'));
    }

    public function edit(Candidature $candidature, Entretien $entretien)
    {
        return view('entretiens.edit', compact('candidature', 'entretien'));
    }

    public function update(UpdateEntretienRequest $request, Candidature $candidature, Entretien $entretien)
    {
        $entretien->update($request->validated());

        return redirect()->route('candidatures.entretiens.index', $candidature)
            ->with('success', 'Entretien mis à jour.');
    }

    public function archiver(Candidature $candidature, Entretien $entretien)
    {
        $entretien->archiver();

        return redirect()->route('candidatures.entretiens.index', $candidature)
            ->with('success', 'Entretien archivé.');
    }

    public function forceDelete(Candidature $candidature, Entretien $entretien)
    {
        $entretien->forceDelete();
    }

    public function restore(Candidature $candidature, Entretien $entretien)
    {
        $entretien->restore();

        return redirect()->route('candidatures.entretiens.index', $candidature)
            ->with('success', 'Entretien restauré.');
    }

    public function destroy(Candidature $candidature, Entretien $entretien)
    {
        $entretien->delete();

        return redirect()->route('candidatures.entretiens.index', $candidature)
            ->with('success', 'Entretien supprimé.');
    }
}
