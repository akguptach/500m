<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceWhyEducrafterRequest extends FormRequest
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
            'addMoreSpecificationFields.*.title' => 'required',
            'addMoreSpecificationFields.*.description' => 'required',
            // 'addMoreSpecificationFields.*.icon' => 'required_without:addMoreSpecificationFields.*.icon_url',
            'service_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'addMoreSpecificationFields.*.title.required' => 'Title is required',
            'addMoreSpecificationFields.*.description.required' => 'Description is required',
            'addMoreSpecificationFields.*.icon.required_without' => 'Icon is required',
            'service_id.required' => 'required'
        ];
    }

    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->previous() . '#why_educrafter';
    }
}
