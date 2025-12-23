<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IzvestajStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'naziv' => ['required', 'string'],
            'datum' => ['required', 'date'],
            'status' => ['required', 'string'],
            'korisnik_id' => ['required', 'integer', 'exists:korisniks,id'],
            'zahtev_id' => ['required', 'integer', 'exists:zahtevs,id'],
            'korisnik_zahtev_id' => ['required', 'integer', 'exists:korisnik_zahtevs,id'],
        ];
    }
}
