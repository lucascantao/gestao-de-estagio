<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'perfilId' => 'required',
            'cursoId' => 'required',
            // 'address' => 'nullable|string',
            // 'phone' => [
            //     'required',
            //     'string',
            //     'regex:/^(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/'
            // ],
            // 'birthdate' => 'nullable|date',
            // 'gender' => 'nullable|string|in:masculino,feminino,outro',
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'O campo name é obrigatório.',
            'name.string' => 'O campo name deve ser uma string.',
            'name.max' => 'O campo name deve ter no máximo 100 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um email válido.',
            'email.unique' => 'O campo email deve ser único.',
            'password.required' => 'O campo Senha é obrigatório.',
            'password.string' => 'O campo Senha deve ser uma string.',
            'password.min' => 'O campo Senha deve ter no mínimo 8 caracteres.',
            'perfisId.required' => 'O perfil é obrigatório',
            'perfisId.exists' => 'O perfil selecionado não existe',
            // 'phone.regex' => 'O campo telefone deve ser um telefone válido',
            // 'phone.required' => 'O campo telefone é obrigatório',
            // 'phone.string' => 'O campo telefone deve ser uma string',
            // 'address.string' => 'O campo endereço deve ser uma string',
            // 'birthdate.date' => 'O campo data de nascimento deve ser uma data válida.',
            // 'gender.string' => 'O campo gênero deve ser uma string.',
            // 'gender.in' => 'O campo gênero deve ser masculino, feminino ou outro.',
        ];
    }
}
