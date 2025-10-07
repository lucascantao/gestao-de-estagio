<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyTokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string|size:6'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser um endereço válido',
            'email.exists' => 'Email não encontrado',
            'token.required' => 'O token é obrigatório',
            'token.size' => 'O token deve ter 6 caracteres'
        ];
    }
}
