<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $employeeId = $this->route('id'); // Assuming your route parameter is {id}

        return [
            'id_card_number' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('employees')->ignore($employeeId),
            ],
            'employee_name' => 'nullable|string|max:255',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('employees')->ignore($employeeId),
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:14',
                Rule::unique('employees')->ignore($employeeId),
            ],
            'designation' => 'nullable|string|max:255',
            'department_id' => 'nullable|numeric|exists:departments,id',
            'nid_number' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('employees')->ignore($employeeId),
            ],
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'joining_date' => 'nullable|date',
            'present_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
        ];
    }
}
