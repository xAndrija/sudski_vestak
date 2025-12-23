<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerenskiPodaciStoreRequest extends FormRequest
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
            'datum_terena' => ['required', 'date'],
            'opis_terena' => ['required', 'string'],
            'merenja' => ['required', 'string'],
            'fotografije' => ['required', 'string'],
            'analize' => ['required', 'string'],
            'zahtev_id' => ['required', 'integer', 'exists:Zahtevs,id'],
        ];
    }
}
