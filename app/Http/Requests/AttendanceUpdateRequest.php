<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttendanceUpdateRequest extends FormRequest
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
        $attendanceId = $this->route('id'); 

        return [
            'id_card_no' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('attendances')->ignore($attendanceId),
            ],
            'employee_name' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'status' => 'nullable|string|in:present,absent',
        ];
    }
}
