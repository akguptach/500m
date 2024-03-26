<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWebsiteRequest extends FormRequest
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
            'website_name' => 'required|unique:websites,website_name,' . $this->website,
            'person_name' => 'required|max:150|min:2',
            'email' => 'required|email',
            'mobile_no' => 'required|numeric',
            'website_type' => 'required',
            'price' => 'required',
            'no_words' => 'required|numeric',
            'additional_words' => 'required',
            'currency' => 'required',
            'currency_sign' => 'required',
            'login_username' => 'required|min:5',
            'order_prefix' => 'required',
            'order_padding' => 'required',
            'txn_fee' => 'required',
            'admin_commission' => 'required',
            'status' => 'required',
        ];
    }
}
