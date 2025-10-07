<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|same:passwordConfirmation',
            'passwordConfirmation' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Informe o e-mail da sua conta.',
            'email.email' => 'Informe um e-mail válido.',
            'email.exists' => 'Conta de e-mail não encontrada.',
            'token.required' => 'Informe o token de recuperação.',
            'password.required' => 'Informe a nova senha.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A senha deve ser confirmada.',
        ];
    }
}
