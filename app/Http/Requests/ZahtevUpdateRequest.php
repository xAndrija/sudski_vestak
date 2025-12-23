<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZahtevUpdateRequest extends FormRequest
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
            'broj_zahteva' => ['required', 'string'],
            'opis' => ['required', 'string'],
            'tip_vestacenja' => ['required', 'string'],
            'lokacija' => ['required', 'string'],
            'hitnost' => ['required', 'string'],
            'status' => ['required', 'string'],
            'datum_podnosenja' => ['required', 'date'],
            'klijent_id' => ['required', 'integer', 'exists:Klijents,id'],
        ];
    }
}
