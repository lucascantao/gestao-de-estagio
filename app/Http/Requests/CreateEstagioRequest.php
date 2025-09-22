<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEstagioRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'carga_horaria' => 'required|numeric',
            'horario' => 'required|string',
            'data_inicio' => 'required|date',
            'data_termino' => 'required|date',
            'salario' => 'required|numeric',
            'observacao' => 'nullable|string',
            'supervisor' => 'required|string',
            // 'estagios_status_id' => 'required|integer',
            'users_id' => 'required|integer',

            'empresas_id' => 'nullable|integer',
            'empresa' => 'nullable|array',
            'empresa.nome' => 'nullable|string',
            'empresa.cnpj' => 'nullable|string',
            'empresa.endereco' => 'nullable|string',
            'empresa.email' => 'nullable|email',
            'empresa.telefone' => 'nullable|string',

        ];
    }

    // TODO: Criar lógica de cadastro das informações de empresa: Apenas empresas_id OU Apenas Array da empresa

    // /**
    //  * Get custom messages for validator errors.
    //  */
    // public function messages(): array
    // {
    //     return [

    //     ];
    // }
}
