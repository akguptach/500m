<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRatingRequest extends FormRequest
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
            'page_id' => 'required',
            'addMoreRatingFields.*.star_rating' => 'required',
            'addMoreRatingFields.*.description' => 'required',
            'addMoreRatingFields.*.user_image' => 'required_without:addMoreRatingFields.*.user_image_url',
            'addMoreRatingFields.*.address' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'page_id.required' => 'Service id is required',
            'addMoreRatingFields.*.star_rating.required' => 'Rating is required',
            'addMoreRatingFields.*.description.required' => 'Description is required',
            'addMoreRatingFields.*.user_image.required_without' => 'Image is required',
            'addMoreRatingFields.*.address.required' => 'address is required'
        ];
    }

    protected function getRedirectUrl()
    {
        return $this->redirector->getUrlGenerator()->previous() . '#ratings';
    }
}
