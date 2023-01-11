<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\Api\FormRequest;

class ForgetPasswordRequest extends FormRequest
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
            'email'         => 'required|email|exists:users,email',
        ];
    }
}
