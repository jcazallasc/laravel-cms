<?php

namespace App\Http\Requests\Tags;

use App\Http\Requests\Tags\BaseTagRequest;

class StoreTagRequest extends BaseTagRequest
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
