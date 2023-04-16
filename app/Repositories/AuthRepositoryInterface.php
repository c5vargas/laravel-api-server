<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Passport\PersonalAccessTokenResult;

interface AuthRepositoryInterface extends EloquentRepositoryInterface {

    public function getAuth(): PersonalAccessTokenResult;

    public function create(Array $data): Model;

    public function login(String $email, String $password): Array|Bool;

    public function updateUserProfile(Array $data): Bool;

    public function resetPassword(Request $request): Bool;

    public function forgetPassword(Array $data): ?Array;
}

