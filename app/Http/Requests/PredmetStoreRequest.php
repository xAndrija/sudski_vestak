<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PredmetStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $uloga = $user?->uloga?->naziv;

        return in_array($uloga, ['Administrator', 'Sudski veštak', 'Sudija'], true);
    }

    public function rules(): array
    {
        return [
            'broj' => ['required', 'string', Rule::unique('predmets', 'broj')],
            'vrsta' => ['required', 'string'],
            'sud' => ['nullable', 'string'],
            'datum_prijema' => ['nullable', 'date'],
            'rok' => ['nullable', 'date'],
            'status' => ['required', 'string'],
        ];
    }
}
