<?php

namespace App\Http\Requests\Posts;

use App\Http\Requests\Posts\BasePostRequest;

class StorePostRequest extends BasePostRequest
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
        return parent::rules() + [
            'image' => 'required|image',
        ];
    }
}
