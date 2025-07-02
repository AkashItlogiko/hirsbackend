<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryCreateRequest extends FormRequest
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
            'employee_id' => 'required|string|max:255|exists:employees,id',
            'department_id' => 'required|string|max:255|exists:departments,id',
            'pay_date' => 'required|date',
            'net_salary' => 'required|string|min:0',
        ];
    }
}
