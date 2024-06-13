<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpertRequest extends FormRequest
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
            'first_name'=> 'required',
            'competences'=> 'required',
            'description'=> 'required',
            'image'=> 'required',
            'language'=> 'required',
            'online_status'=> 'required',
            'paper_number'=> 'required',
            'qualification'=> 'required',
            'rating_numbers'=> 'required',
            'ratings'=> 'required',
            'subject'=> 'required',
            'subject_number'=> 'required',
            'success_rate'=> 'required',
            'total_orders'=> 'required',
            'type_of_paper'=> 'required'
        ];
    }
}