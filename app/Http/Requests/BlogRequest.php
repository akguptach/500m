<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'blog_title' => 'required|unique:blog,blog_title,' . $this->blog,
            'category_id' => 'required',
            'website_id' => 'required',
            //'blog_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_image' => 'image|mimes:jpeg,png,jpg,gif',
            'blog_description' => 'required',
            'blog_date' => 'required',
        ];
    }
}
