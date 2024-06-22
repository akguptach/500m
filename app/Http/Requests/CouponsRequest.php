<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponsRequest extends FormRequest
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
            'code' => 'required|min:2|unique:coupons,code,' . $this->coupon,
            'start_date' => 'required|date_format:Y-m-d|nullable',
            'end_date' => 'required|date_format:Y-m-d|nullable',
            'max_uses' => 'required',
            'reduction_type' => 'required',
            'reduction_amount' => 'required',
            'limit_per_users' => 'required',
            'website_type' => 'required', 
    ];
    }
}