<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRatingRequest extends FormRequest
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
            'service_id' => 'required',
            'addMoreRatingFields.*.star_rating' => 'required',
            'addMoreRatingFields.*.description' => 'required',
            // 'addMoreRatingFields.*.user_image' => 'required_without:addMoreRatingFields.*.user_image_url',
            'addMoreRatingFields.*.address' => 'required'
        ];
        //dimensions:max_width=300,max_height=200|
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'Service id is required',
            'addMoreRatingFields.*.star_rating.required' => 'Rating is required',
            'addMoreRatingFields.*.description.required' => 'Description is required',
            'addMoreRatingFields.*.user_image.required_without' => 'Image is required',
            'addMoreRatingFields.*.address.required' => 'address is required',
            'addMoreRatingFields.*.user_image.dimensions' => 'Image dimensions should be less than or equal to 300x200',
        ];
    }

    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->previous() . '#ratings';
    }
}