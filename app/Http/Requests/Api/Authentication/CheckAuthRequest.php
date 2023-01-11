<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\Api\FormRequest;

class CheckAuthRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }

}
