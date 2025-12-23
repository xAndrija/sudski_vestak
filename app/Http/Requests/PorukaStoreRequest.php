<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PorukaStoreRequest extends FormRequest
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
            'sadrzaj' => ['required', 'string'],
            'datum_slanja' => ['required', 'date'],
            'posiljalac_id' => ['required', 'integer', 'exists:posiljalacs,id'],
            'primalac_id' => ['required', 'integer', 'exists:primalacs,id'],
            'klijent_korisnik_id' => ['required', 'integer', 'exists:klijent_korisniks,id'],
        ];
    }
}
