<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\Api\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'required|string',
            'email'         => 'required|string|email|max:100|unique:users',
            'password'      => 'required|string|min:4',
        ];
    }
}
