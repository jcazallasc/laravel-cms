<?php

namespace App\Http\Requests\Categories;

use App\Http\Requests\Categories\BaseCategoryRequest;

class UpdateCategoryRequest extends BaseCategoryRequest
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
}
