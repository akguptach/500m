<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqServiceRequest extends FormRequest
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
            'addMoreInputFields.*.question' => 'required',
            'addMoreInputFields.*.answer' => 'required'
        ];
    }

    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->previous() . '#faq';
    }
}
