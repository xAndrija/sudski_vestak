<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Poruka extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sadrzaj',
        'datum_slanja',
        'posiljalac_id',
        'primalac_id',
        'klijent_korisnik_id',
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
            'datum_slanja' => 'date',
            'posiljalac_id' => 'integer',
            'primalac_id' => 'integer',
            'klijent_korisnik_id' => 'integer',
        ];
    }

    public function klijentKorisnik(): BelongsTo
    {
        return $this->belongsTo(KlijentKorisnik::class);
    }

    public function posiljalac(): BelongsTo
    {
        return $this->belongsTo(Posiljalac::class);
    }

    public function primalac(): BelongsTo
    {
        return $this->belongsTo(Primalac::class);
    }
}
