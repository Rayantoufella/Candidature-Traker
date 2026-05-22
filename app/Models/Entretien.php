<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    protected $table = 'entretien';

    protected $fillable = [
        'titre',
        'note',
        'description',
        'type',
        'resultat',
        'date_entretien',
        'candidature_id',
    ];

    protected function casts(): array
    {
        return [
            'date_entretien' => 'datetime',
        ];
    }

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }
}
