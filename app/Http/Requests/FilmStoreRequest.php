<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmStoreRequest extends FormRequest
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
            'zanr_id' => ['required', 'exists:zanrs,ZanrId'],
            'Naziv' => ['required', 'max:100', 'string'],
            'Status' => ['in:predprodukcija,produkcija,postprodukcija,pauza,planiranje,distribucija,arhiviran',
            ],
            'Budzet' => ['required', 'numeric', 'min:0'],
            'DatumIzlaska' => ['nullable', 'date'],
        ];
    }
}
