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
    ];

    protected $casts = [
        'applied_at' => 'date',
    ];

    const STATUS_TO_REVIEW = 'to_review';
    const STATUS_INTERVIEW_SCHEDULED = 'interview_scheduled';
    const STATUS_OFFER_RECEIVED = 'offer_received';
    const STATUS_REJECTED = 'rejected';
    const STATUS_ABANDONED = 'abandoned';

    public static function statuses(): array
    {
        return [
            self::STATUS_TO_REVIEW => 'À examiner',
            self::STATUS_INTERVIEW_SCHEDULED => 'Entretien planifié',
            self::STATUS_OFFER_RECEIVED => 'Offre reçue',
            self::STATUS_REJECTED => 'Refusé',
            self::STATUS_ABANDONED => 'Abandonné',
        ];
    }

    public static function priorites(): array
    {
        return [
            'low' => 'Basse',
            'medium' => 'Moyenne',
            'high' => 'Haute',
        ];
    }
}
