<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntretienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'note' => 'nullable|string',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'resultat' => 'nullable|string|max:255',
            'date_entretien' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est requis.',
            'type.required' => 'Le type est requis.',
        ];
    }
}
