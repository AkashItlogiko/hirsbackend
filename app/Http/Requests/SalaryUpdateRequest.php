<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SalaryUpdateRequest extends FormRequest
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
        $salaryId = $this->route('id'); 

        return [
            'id_card_no' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('salaries')->ignore($salaryId),
            ],
            'employee_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'pay_date' => 'nullable|date',
            'net_salary' => 'nullable|string|min:0',
        ];
    }
}
