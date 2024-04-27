<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceAssistButtonRequest extends FormRequest
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
            'addMoreFields.*.btn_text' => 'required',
            'addMoreFields.*.btn_url' => 'required',
            'service_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'addMoreFields.*.btn_text.required' => 'Button Text is required',
            'addMoreFields.*.btn_url.required' => 'Url is required',
            'service_id.required' => 'required'
        ];
    }

    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->previous() . '#assist_buttons';
    }
}