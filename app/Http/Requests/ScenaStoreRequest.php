<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScenaStoreRequest extends FormRequest
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
            'film_id' => ['required', 'exists:films,FilmId'],
            'Lokacija' => ['required', 'max:255', 'string'],
            'DatumSnimanja' => ['nullable', 'date'],
        ];
    }
}
