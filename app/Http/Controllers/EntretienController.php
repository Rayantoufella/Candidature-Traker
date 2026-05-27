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
        $this->authorize('viewAny', Entretien::class);
        $entretiens = $candidature->entretiens()->latest()->get();

        return view('entretiens.index', compact('candidature', 'entretiens'));
    }

    public function create(Candidature $candidature)
    {
        $this->authorize('create', Entretien::class);
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
        $this->authorize('view', $entretien);
        return view('entretiens.show', compact('candidature', 'entretien'));
    }

    public function edit(Candidature $candidature, Entretien $entretien)
    {
        $this->authorize('update', $entretien);
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
        $this->authorize('archiver', $entretien);
        $entretien->archiver();

        return redirect()->route('candidatures.entretiens.index', $candidature)
            ->with('success', 'Entretien archivé.');
    }

    public function forceDelete(Candidature $candidature, Entretien $entretien)
    {
        $this->authorize('forceDelete', $entretien);
        $entretien->forceDelete();
    }

    public function restore(Candidature $candidature, Entretien $entretien)
    {
        $this->authorize('restore', $entretien);
        $entretien->restore();

        return redirect()->route('candidatures.entretiens.index', $candidature)
            ->with('success', 'Entretien restauré.');
    }

    public function destroy(Candidature $candidature, Entretien $entretien)
    {
        $this->authorize('delete', $entretien);
        $entretien->delete();

        return redirect()->route('candidatures.entretiens.index', $candidature)
            ->with('success', 'Entretien supprimé.');
    }
}
