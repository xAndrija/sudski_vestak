<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Izvestaj extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naziv',
        'sadrzaj',
        'datum',
        'status',
        'pdf_putanja',
        'korisnik_id',
        'zahtev_id',
        'korisnik_zahtev_id',
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
            'datum' => 'date',
            'korisnik_id' => 'integer',
            'zahtev_id' => 'integer',
            'korisnik_zahtev_id' => 'integer',
        ];
    }

    public function korisnikZahtev(): BelongsTo
    {
        return $this->belongsTo(KorisnikZahtev::class);
    }

    public function korisnik(): BelongsTo
    {
        return $this->belongsTo(Korisnik::class);
    }

    public function zahtev(): BelongsTo
    {
        return $this->belongsTo(Zahtev::class);
    }
}
