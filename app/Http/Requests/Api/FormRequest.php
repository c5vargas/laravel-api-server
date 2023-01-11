<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

abstract class FormRequest extends LaravelFormRequest
{
    abstract public function rules();

    abstract public function authorize();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(
                [
                    'status'    => 400,
                    'message'   => 'Validation errors',
                    'errors'    => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status'    => 400,
                    'message'   => 'Operation not authorized',
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
