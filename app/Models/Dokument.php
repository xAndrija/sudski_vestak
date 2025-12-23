<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naziv',
        'tip',
        'putanja',
        'datum_dodavanja',
        'terenski_podaci_id',
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
            'datum_dodavanja' => 'date',
            'terenski_podaci_id' => 'integer',
        ];
    }

    public function terenskiPodaci(): BelongsTo
    {
        return $this->belongsTo(TerenskiPodaci::class);
    }
}
