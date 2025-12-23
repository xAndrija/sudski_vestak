<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TerenskiPodaci extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'datum_terena',
        'opis_terena',
        'merenja',
        'fotografije',
        'analize',
        'zahtev_id',
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
            'datum_terena' => 'date',
            'zahtev_id' => 'integer',
        ];
    }

    public function zahtev(): BelongsTo
    {
        return $this->belongsTo(Zahtev::class);
    }

    public function dokuments(): HasMany
    {
        return $this->hasMany(Dokument::class);
    }
}
