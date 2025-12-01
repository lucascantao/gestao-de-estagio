<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacanceRequest extends FormRequest
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
            'title' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'number_of_positions' => 'nullable|integer|min:1',
            'requirements' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric',
            'application_deadline' => 'nullable|date',
        ];
    }
}
