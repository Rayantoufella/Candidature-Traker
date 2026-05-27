<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entretien extends Model
{
    use SoftDeletes;

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

    public function archiver(): void
    {
        $this->delete();
    }
}
