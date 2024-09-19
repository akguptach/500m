<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateUserUpdateRequest extends FormRequest
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
        //print_r(request()->id); die;
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:student,email,' . request()->id,
            'about' => 'required',
            'location' => 'required',
            'website_id' => 'required',
            'commission' => 'required',
    ];
    }
}