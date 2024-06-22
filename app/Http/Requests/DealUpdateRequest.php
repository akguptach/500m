<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealUpdateRequest extends FormRequest
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
            'title'=> 'required',
            'deal_category'=> 'required',
            //'image'=> 'required',
            'short_description'=> 'required',
            'long_description'=> 'required',
            'url'=> 'required',
            'other_price'=> 'required',
            'price_type'=> 'required',
            'offer_price'=> 'required_if:price_type,Price',
            'price'=> 'required_if:price_type,Price',
            'voucher_code'=> 'required_if:price_type,Voucher_Code',
            'website_type'=>'required'
        ];
    }
}