<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\FormRequest;

class UserUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return (!auth()->check() || !$this->user_id) ?  false :  true;
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
            'email'         => 'required|email|max:191|unique:users,email,' . $this->user_id,
            'name'          => 'required|string|max:191',
            'dni'           => 'required|string',
            'company'       => 'nullable|string',
            'phone'         => 'nullable|string|max:191',
            'address'       => 'nullable|string',
            'city'          => 'nullable|string',
            'postal_code'   => 'nullable|string',
        ];
    }
}
