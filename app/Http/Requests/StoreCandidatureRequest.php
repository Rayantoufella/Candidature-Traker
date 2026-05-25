<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entreprise' => 'required|string|max:255',
            'post' => 'required|string|max:255',
            'URL' => 'nullable|url|max:255',
            'status' => 'required|in:to_review,interview_scheduled,offer_received,rejected,abandoned',
            'priorite' => 'required|in:low,medium,high',
            'description' => 'nullable|string',
            'applied_at' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'entreprise.required' => "Le nom de l'entreprise est requis.",
            'post.required' => 'Le poste est requis.',
            'URL.url' => "L'URL doit être une adresse valide.",
            'status.required' => 'Le statut est requis.',
            'status.in' => 'Le statut sélectionné est invalide.',
            'priorite.required' => 'La priorité est requise.',
            'priorite.in' => 'La priorité sélectionnée est invalide.',
        ];
    }
}
