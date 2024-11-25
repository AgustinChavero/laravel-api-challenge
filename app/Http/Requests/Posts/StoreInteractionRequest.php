<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StoreInteractionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'liked' => 'sometimes|boolean',
            'shared' => 'sometimes|boolean',
            'favorited' => 'sometimes|boolean',
            'saved' => 'sometimes|boolean',
        ];
    }
}
