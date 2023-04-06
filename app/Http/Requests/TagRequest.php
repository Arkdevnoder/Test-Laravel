<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'integer' => 'The :attribute is not integer',
            'required'  => 'The :attribute is required',
            'max'  => 'The :attribute has maximum symbols',
            'image'  => 'The :attribute is not image',
            'mimes'  => 'Wrong MIMEs',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
        ];
    }
}
