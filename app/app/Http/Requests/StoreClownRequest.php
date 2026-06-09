<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClownRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Jeder darf einen Clown erstellen.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string',
            'email'       => 'required|email|max:255',
            'description' => 'nullable|string',
            'rating'      => 'required|integer|between:1,5',
            'status'      => 'required|in:active,passive,unknown',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'   => 'Der Name ist ein Pflichtfeld.',
            'email.required'  => 'Die E-Mail-Adresse ist ein Pflichtfeld.',
            'email.email'     => 'Die E-Mail-Adresse muss eine gültige E-Mail-Adresse sein.',
            'email.max'       => 'Die E-Mail-Adresse darf maximal 255 Zeichen lang sein.',
            'rating.between'  => 'Das Rating muss eine Ganzzahl zwischen 1 und 5 sein.',
            'status.in'       => 'Der Status muss active, passive oder unknown sein.',
        ];
    }
}
