<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\Api\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!auth()->check() || !$this->user_id) return false;

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
            'user_id'       => 'required|exists:users,id',
            'name'          => 'required|string',
            'email'         => 'required|string|email|max:100|unique:users,email,' . $this->user_id,
        ];
    }
}
