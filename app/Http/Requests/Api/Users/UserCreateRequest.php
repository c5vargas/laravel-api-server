<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|string',
            'email'         => 'required|string|email|max:100|unique:users',
            'password'      => 'required|string|min:4',
        ];
    }
}
