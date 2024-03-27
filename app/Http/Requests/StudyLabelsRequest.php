<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudyLabelsRequest extends FormRequest
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
            'label_name' => 'required|unique:study_labels,label_name',
            'price' => 'required',

        ];
    }
}
