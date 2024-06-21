<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpertRequest extends FormRequest
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
            'competences'=> 'required|array',
            'description'=> 'required',
            'language'=> 'required',
            'online_status'=> 'required',
            'qualification'=> 'required',
            'rating_numbers'=> 'required',
            'success_rate'=> 'required',
            'total_orders'=> 'required',
            'website_type'=>'required',
            'addMoreSubject.*.expert_subject' => 'required',
            'addMoreSubject.*.subject_number' => 'required',
            'addMorePaper.*.paper_number' => 'required',
            'addMorePaper.*.type_of_paper' => 'required',

        ];
    }

    public function messages(): array
    {
        return [
            'addMoreSubject.*.expert_subject.required' => 'Subject should not blank',
            'addMoreSubject.*.subject_number.required' => 'Subject number should not blank',
            'addMorePaper.*.paper_number.required' => 'Type of paper number should not blank',
            'addMorePaper.*.type_of_paper.required' => 'Type of paper should not blank',
        ];
    }
}