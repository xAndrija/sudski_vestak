<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predmet extends Model
{
    use HasFactory;

    protected $fillable = [
        'broj',
        'vrsta',
        'sud',
        'rok',
        'status',
        'datum_prijema',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'rok' => 'date',
            'datum_prijema' => 'date',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        $status = $this->status;

        return [
            'novo' => 'Novo',
            'u_obradi' => 'U obradi',
            'zavrsen' => 'Završen',
            'odbijen' => 'Odbijen',
        ][$status] ?? ($status ?? '');
    }
}
