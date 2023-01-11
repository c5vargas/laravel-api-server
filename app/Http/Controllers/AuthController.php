<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\AuthRepository;
use App\Events\WantResetPassword;
use App\Http\Requests\Api\Authentication\CheckAuthRequest;
use App\Http\Requests\Api\Authentication\RegisterRequest;
use App\Http\Requests\Api\Authentication\ResetPasswordRequest;
use App\Http\Requests\Api\Authentication\LoginRequest;
use App\Http\Requests\Api\Authentication\UpdateUserRequest;
use App\Http\Requests\Api\Authentication\ForgetPasswordRequest;
use App\Http\Transformers\UserTransformer;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @property UserRepositoryInterface
     */
    private $repository;

    public function __construct(
        UserTransformer $transformer,
        AuthRepository $repository,
        Request $request
    ){
        parent::__construct($transformer, $request);
        $this->repository = $repository;
    }

    public function getAuth(CheckAuthRequest $request)
    {
       $token = $this->repository->getAuth($request);

       if(!$token) {
            return $this->respondWithError('Token no válido.', 401);
        }

       return $this->respondWithToken($token, auth()->guard('api')->user());
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->repository->create($request->validated());

        return $this->respondWithItem($user);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->repository->login($request->input('email'), $request->input('password'));

        if(!$result) {
            return $this->respondWithError('Credenciales inválidas proporcionadas.', 401);
        }

        return $this->respondWithToken($result['token'], $result['user']);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if($user) $user->token()->revoke();

        return $this->respondWithMessage('Se ha cerrado la sesión con éxito.');
    }

    public function updateUserProfile(UpdateUserRequest $request)
    {
        $updated = $this->repository->updateUserProfile($request->validated());

        if(!$updated) {
            return $this->respondWithError('No se ha podido actualizar tu perfil.', 500);
        }

        return $this->respondWithMessage('Su cuenta ha sido actualizada con éxito.');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = $this->repository->resetPassword($request);

        if(!$status) {
            return $this->respondWithError('El token o el correo electrónico no es válido.', 401);
        }

        return $this->respondWithMessage('La contraseña se ha restablecido correctamente.');
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $result = $this->repository->forgetPassword($request->validated());

        if(!$result['user']) {
            return $this->respondWithError('El correo electrónico proporcionado no es válido.', 401);
        }

        WantResetPassword::dispatch($result['user'], $result['token']);

        return $this->respondWithMessage('Se ha enviado un correo electrónico con los pasos para restablecer la contraseña.');
    }
}
