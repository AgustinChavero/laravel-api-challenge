<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'language_id' => 'required|exists:languages,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone|max:20',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'birth_date' => 'required|date',
        ];
    }
}
