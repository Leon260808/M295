<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Jeder darf sich einloggen.
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
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
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
            'email.required'    => 'Die E-Mail-Adresse ist ein Pflichtfeld.',
            'email.email'       => 'Die E-Mail-Adresse muss eine gültige E-Mail-Adresse sein.',
            'password.required' => 'Das Passwort ist ein Pflichtfeld.',
            'password.min'      => 'Das Passwort muss mindestens 8 Zeichen lang sein.',
        ];
    }
}
