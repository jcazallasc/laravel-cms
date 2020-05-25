<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class BaseCategoryRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:categories|min:6|max:50',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
        ];
    }
}
