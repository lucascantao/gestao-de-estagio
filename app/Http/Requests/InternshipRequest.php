<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternshipRequest extends FormRequest
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
            'page' => 'required|integer|min:1',
            'perPage' => 'required|integer|min:1',
            'sort' => 'nullable|string',
            'direction' => 'nullable|in:asc,desc',
        ];
    }

    // /**
    //  * Get custom messages for validator errors.
    //  */
    // public function messages(): array
    // {
    //     return [

    //     ];
    // }
}
