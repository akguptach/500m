<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelStudyRequest extends FormRequest
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
            'level_name' => 'required',
            'price' => 'required',
            'website_type' => 'required',
        ];
    }
}
