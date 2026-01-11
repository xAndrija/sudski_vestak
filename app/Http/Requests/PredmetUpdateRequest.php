<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PredmetUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $uloga = $user?->uloga?->naziv;

        return $uloga === 'Administrator';
    }

    public function rules(): array
    {
        $predmet = $this->route('predmet');

        return [
            'broj' => ['required', 'string', Rule::unique('predmets', 'broj')->ignore($predmet?->id)],
            'vrsta' => ['required', 'string'],
            'sud' => ['nullable', 'string'],
            'datum_prijema' => ['nullable', 'date'],
            'rok' => ['nullable', 'date'],
            'status' => ['required', 'string'],
        ];
    }
}
