<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'currentPassword' => 'required|string',
            'password' => 'required|string|min:8|same:passwordConfirmation',
            'passwordConfirmation' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'currentPassword.required' => 'O campo Senha Atual é obrigatório.',
            'currentPassword.string' => 'O campo Senha Atual deve ser uma string.',

            'password.required' => 'O campo Nova Senha é obrigatório.',
            'password.string' => 'O campo Nova Senha deve ser uma string.',
            'password.min' => 'O campo Nova Senha deve ter no mínimo 8 caracteres.',
            'password.same' => 'O campo Nova Senha deve ser igual ao campo Senha de confirmação.',

            'passwordConfirmation.required' => 'O campo Senha de confirmação é obrigatório.',
        ];
    }
}
