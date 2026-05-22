<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise',
        'post',
        'URL',
        'status',
        'priorite',
        'description',
        'applied_at',
        'user_id',
    ];

    protected $casts = [
        'applied_at' => 'date',
    ];

    public static function priorites(): array
    {
        return [
            'low' => 'Basse',
            'medium' => 'Moyenne',
            'high' => 'Haute',
        ];
    }

    public function getStatusAttribute($value){
        return match($value){
            'to_review' => 'À revoir',
            'interview_scheduled' => 'Entretien programmé',
            'offer_received' => 'Offre reçue',
            'rejected' => 'Rejeté',
            'abandoned' => 'Abandonné',
            default => $value,
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entretiens()
    {
        return $this->hasMany(Entretien::class);
    }
}
