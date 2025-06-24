<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            //
            'id_card_number' => 'nullable|string|max:255|unique:employees',
            'employee_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:employees',
            'phone_number' => 'nullable|string|max:14|unique:employees',
            'designation' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ];
    }
}
