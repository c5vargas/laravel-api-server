<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\AuthRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAuth(): PersonalAccessTokenResult|bool
    {
        $auth = auth()->guard('api')->user();

        if(!$auth)
            return false;

        $user = $this->find($auth->id);

        $token = $user->createToken(config('app.key'));
        $user->last_online = Carbon::now()->toDateTimeString();
        $user->save();

        return $token;
    }

    public function create(Array $data): Model
    {
        $user = $this->model->fill($data);
        $user->last_online = Carbon::now()->toDateTimeString();

        $user->save();
        $user->createToken(config('app.key'));

        return $user;
    }

    public function login(String $email, String $password): Array|Bool
    {
        $user = $this->model->where('email', $email)->first();

        if(!$user)
            return false;

        if(!Hash::check($password, $user->password))
            return false;

        $token = $user->createToken(config('app.key'));

        $user->last_online = Carbon::now()->toDateTimeString();
        $user->save();

        return ['user' => $user, 'token' => $token];
    }

    public function updateUserProfile(Array $data): Bool
    {
        $updated = $this->model->findOrFail($data['user_id'])->update($data);
        return $updated;
    }

    public function resetPassword(Request $request): Bool
    {
        $isValid = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        $user = $this->model->where('email', $request->email)->first();

        if(!$isValid || !$user)
            return false;

        $user->password = $request->password;
        $saved = $user->save();

        if($saved)
            DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return $saved;
    }

    public function forgetPassword(Array $data): ?Array
    {
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $data['email'],
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = $this->model->where('email', $data['email'])->firstOrFail();

        return ['user' => $user, 'token' => $token];
    }

}
