<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QcAssignRequest extends FormRequest
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
            'teacher_id' => 'required',
            'delivery_date' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'teacher_id.required' => 'Please select at least one QC',
        ];
    }
}
