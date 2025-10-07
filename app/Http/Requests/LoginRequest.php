<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um email válido.',
            'email.max' => 'O campo email deve ter no máximo 100 caracteres.',

            'password.required' => 'O campo Senha é obrigatório.',
            'password.min' => 'O campo Senha deve ter no mínimo 8 caracteres.',
            'password.max' => 'O campo Senha deve ter no máximo 50 caracteres.',
        ];
    }
}
