<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Zahtev extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'broj_zahteva',
        'opis',
        'tip_vestacenja',
        'lokacija',
        'hitnost',
        'status',
        'datum_podnosenja',
        'klijent_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'datum_podnosenja' => 'date',
            'klijent_id' => 'integer',
        ];
    }

    public function klijent(): BelongsTo
    {
        return $this->belongsTo(Klijent::class);
    }

    public function terenskiPodaci(): HasOne
    {
        return $this->hasOne(TerenskiPodaci::class);
    }
}
