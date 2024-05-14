<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ServiceHowWorksRequest extends FormRequest
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
            'addMoreFields.*.title' => 'required',
            'addMoreFields.*.description' => 'required',
            // 'addMoreFields.*.icon' => 'required_without:addMoreFields.*.icon_url',
            'service_id' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'addMoreFields.*.title.required' => 'Title is required',
            'addMoreFields.*.description.required' => 'Description is required',
            'addMoreFields.*.icon.required_without' => 'Icon is required',
            'service_id.required' => 'required'
        ];
    }
    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->previous() . '#how_works';
    }
}