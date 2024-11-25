<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class ToggleRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
