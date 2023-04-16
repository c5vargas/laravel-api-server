<?php

namespace App\Http\Controllers;

use App\Events\WantResetPassword;
use App\Http\Requests\Api\Authentication\CheckAuthRequest;
use App\Http\Requests\Api\Authentication\ForgetPasswordRequest;
use App\Http\Requests\Api\Authentication\LoginRequest;
use App\Http\Requests\Api\Authentication\RegisterRequest;
use App\Http\Requests\Api\Authentication\ResetPasswordRequest;
use App\Http\Requests\Api\Authentication\UpdateUserRequest;
use App\Http\Transformers\UserTransformer;
use App\Repositories\Eloquent\AuthRepository;
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
            return $this->respondWithError( __('controller.auth.no_token'), 401);
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
            return $this->respondWithError( __('controller.auth.invalid_password'), 401);
        }

        return $this->respondWithToken($result['token'], $result['user']);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if($user) $user->token()->revoke();

        return $this->respondWithMessage( __('controller.auth.logout'));
    }

    public function updateUserProfile(UpdateUserRequest $request)
    {
        $updated = $this->repository->updateUserProfile($request->validated());

        if(!$updated) {
            return $this->respondWithError( __('controller.auth.profile_failed'), 500);
        }

        return $this->respondWithMessage( __('controller.auth.profile_success'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = $this->repository->resetPassword($request);

        if(!$status) {
            return $this->respondWithError(__('controller.auth.email_or_token_invalid'), 401);
        }

        return $this->respondWithMessage(__('controller.auth.password_reset'));
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $result = $this->repository->forgetPassword($request->validated());

        if(!$result['user']) {
            return $this->respondWithError( __('controller.auth.email_failed'), 401);
        }

        WantResetPassword::dispatch($result['user'], $result['token']);

        return $this->respondWithMessage( __('controller.auth.forget_password'));
    }
}
