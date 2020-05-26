<?php

namespace App\Http\Requests\Posts;

use App\Http\Requests\Posts\BasePostRequest;

class UpdatePostRequest extends BasePostRequest
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
            'title' => 'required|min:6|max:50',
        ];
    }
}
