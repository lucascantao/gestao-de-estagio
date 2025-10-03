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
            'workload' => 'required|string',
            'dayPeriod' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'salary' => 'required|numeric',
            'observation' => 'nullable|string',
            'supervisor' => 'required|string',
            'userId' => 'required|integer',
            'empresaId' => 'nullable|integer',
            'empresa' => 'nullable|array',
            'empresa.name' => 'nullable|string',
            'empresa.cnpj' => 'nullable|string',
            'empresa.address' => 'nullable|string',
            'empresa.email' => 'nullable|email',
            'empresa.phone' => 'nullable|string',

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
