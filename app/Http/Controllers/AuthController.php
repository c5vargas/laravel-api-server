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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
Use Illuminate\Support\Str;

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

    /**
     * This function retrieves authentication token and returns it with user information if available,
     * otherwise throws an exception.
     *
     * @param CheckAuthRequest $request
     *
     * @return Response
     */
    public function getAuth(CheckAuthRequest $request)
    {
       $token = $this->repository->getAuth($request);

       if(!$token)
            throw new Exception(__('controller.auth.no_token'), 401);

       return $this->respondWithToken($token, auth()->guard('api')->user());
    }

    /**
     * This PHP function registers a user and returns a response with the user's information.
     *
     * @param RegisterRequest $request
     *
     * @return Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->repository->create($request->validated());

        if(!$user)
            throw new Exception(__('controller.common.error_500'), 500);

        return $this->respondWithItem($user, 201);
    }

    /**
     * This function handles user login attempts, checks for too many failed attempts, and responds
     * with a token if successful.
     *
     * @param LoginRequest $request
     *
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        $this->checkTooManyFailedAttempts();

        $result = $this->repository->login($request->input('email'), $request->input('password'));

        if(!$result) {
            RateLimiter::hit($this->throttleKey(), $seconds = 3600);
            throw new Exception(__('controller.auth.invalid_password'), 401);
        }

        RateLimiter::clear($this->throttleKey());

        return $this->respondWithToken($result['token'], $result['user']);
    }

    /**
     * This function logs out a user by revoking their token and returns a message.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        if($user) $user->token()->revoke();

        return $this->respondWithMessage( __('controller.auth.logout'));
    }

    /**
     * This function updates a user's profile and returns a success message or throws an exception if
     * the update fails.
     *
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function updateUserProfile(UpdateUserRequest $request)
    {
        $updated = $this->repository->updateUserProfile($request->validated());

        if(!$updated)
            throw new Exception(__('controller.auth.profile_failed'), 500);

        return $this->respondWithMessage( __('controller.auth.profile_success'));
    }

    /**
     * This function resets a user's password and returns a success message or throws an exception if the
     * email or token is invalid.
     *
     * @param ResetPasswordRequest $request
     *
     * @return Response
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = $this->repository->resetPassword($request);

        if(!$status)
            throw new Exception(__('controller.auth.email_or_token_invalid'), 401);

        return $this->respondWithMessage(__('controller.auth.password_reset'));
    }

    /**
     * This function handles the forget password request and dispatches an event to reset the password.
     *
     * @param ForgetPasswordRequest $request
     *
     * @return Response
     */
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $result = $this->repository->forgetPassword($request->validated());

        if(!$result['user']) {
            throw new Exception(__('controller.auth.email_failed'), 401);
        }

        WantResetPassword::dispatch($result['user'], $result['token']);

        return $this->respondWithMessage( __('controller.auth.forget_password'));
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey(): string
    {
        return Str::lower(request('email')) . '|' . request()->ip();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     */
    public function checkTooManyFailedAttempts()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 10)) {
            return;
        }

        throw new Exception(__('controller.auth.login_attempts'), 401);
    }
}
