<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInternshipRequest extends FormRequest
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
            'schedule' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'salary' => 'required|numeric',
            'observation' => 'nullable|string',
            'supervisor' => 'required|string',
            'userId' => 'required|integer',
            'companyId' => 'nullable|integer',
            'company' => 'nullable|array',
            'company.name' => 'nullable|string',
            'company.cnpj' => 'nullable|string',
            'company.address' => 'nullable|string',
            'company.email' => 'nullable|email',
            'company.phone' => 'nullable|string',

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
