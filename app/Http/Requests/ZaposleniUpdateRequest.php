<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZaposleniUpdateRequest extends FormRequest
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
            'Ime' => ['required', 'max:20', 'string'],
            'Prezime' => ['required', 'max:20', 'string'],
            'Uloga' => ['required', 'max:255', 'string'],
            'Status' => ['required', 'in:aktivan,neaktivan,odsutan'],
        ];
    }
}
