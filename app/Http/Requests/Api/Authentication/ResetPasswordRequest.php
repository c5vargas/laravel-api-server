<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\Api\FormRequest;

class ResetPasswordRequest extends FormRequest
{
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
            'token'         => 'required',
            'email'         => 'required|email',
            'password'      => 'required|min:8|confirmed'
        ];
    }
}
