<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'page_title' => 'required|min:2|unique:pages,page_title,' . $this->pages,
            'page_desc' => 'required|min:2',
            'website_type' => 'required',
            'seo_title' => 'required|max:191|unique:pages,seo_title,' . $this->pages,
            'seo_url_slug' => 'required|max:191|unique:pages,seo_url_slug,' . $this->pages,
        ];
    }
}
