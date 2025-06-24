<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
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
            'id_card_number' => 'required|string|max:255|unique:employees',
            'employee_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'phone_number' => 'required|string|max:14|unique:employees',
            'designation' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'department' => 'required|string|max:255',
        ];
    }
}
