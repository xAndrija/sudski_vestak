<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IzvestajUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user?->uloga?->naziv === 'Administrator';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'naziv' => ['required', 'string'],
            'sadrzaj' => ['nullable', 'string'],
            'datum' => ['required', 'date'],
            'status' => ['required', 'string'],
            'pdf_putanja' => ['nullable', 'string'],
            'zahtev_id' => ['nullable', 'integer', 'exists:zahtevs,id'],
            'korisnik_zahtev_id' => ['nullable', 'integer'],
        ];
    }
}
