<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderMessageRequest extends FormRequest
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

        /*return $this->validateWithBag('checkin', [
            'message' => 'required',
            'attachment' => 'required_without:message',
            'receiver_id' => 'required',
            'type' => 'required',
            'order_id' => 'required',
        ]);*/

        return [
            'message' => 'required_without:attachment',
            'attachment' => 'required_without:message',
            'receiver_id' => 'required',
            'type' => 'required',
            'order_id' => 'required',

        ];
    }

    /*public function messages(): array
    {
        return [
            'message.required' => 'this is required',


        ];
    }*/
}
