<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployAttendaceRequest extends FormRequest
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
            'id_card_no'=>'required|string|max:255',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
        ];
    }
}
