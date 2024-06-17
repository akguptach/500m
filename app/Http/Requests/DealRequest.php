<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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
            'price'=> 'required',
            'other_price'=> 'required'
        ];
    }
}