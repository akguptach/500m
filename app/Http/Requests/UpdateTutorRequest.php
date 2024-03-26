<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTutorRequest extends FormRequest
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
            'tutor_first_name' => 'required|max:150|min:2',
            'tutor_last_name' => 'required|max:150|min:2',
            'tutor_email' => 'required|email|unique:tutor,tutor_email,' . $this->tutor,
            'tutor_contact_no' => 'required|numeric|unique:tutor,tutor_contact_no,' . $this->tutor,
            'tutor_subject' => 'required',
            'status' => 'required',
        ];
    }
}
