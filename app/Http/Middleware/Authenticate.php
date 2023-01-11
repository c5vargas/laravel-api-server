<?php

namespace App\Http\Middleware;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status'    => 400,
                    'message'   => 'Token invalid',
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
