<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Passport\PersonalAccessTokenResult;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract as Transformer;

class Controller extends BaseController
{
    use DispatchesJobs;

    /**
     * @property Manager
     */
    protected $fractal;

    /**
     * @property Transformer
     */
    protected $transformer;

    public function __construct(
        Transformer $transformer,
        Request $request
    )
    {
        $this->fractal = new Manager();
        $this->transformer = $transformer;

        $this->fractal->parseIncludes(explode(',', $request->get('include')));
    }

    protected function respondWithToken(PersonalAccessTokenResult $token, object $user)
    {

        $user = new Item($user, $this->transformer);
        $userTransformed = $this->fractal->createData($user)->toArray();

        $data = [
            'token' => $token,
            'user'  => $userTransformed,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }

    protected function respondWithError(string $message, int $status = 500)
    {
        $data = [
            'message' => $message,
            'status' => $status,
        ];

        return response(compact('data'), $status);
    }

    protected function respondWithMessage(string $message, int $status = 200)
    {
        $data = [
            'message' => $message,
            'status' => $status
        ];
        return response()->json($data, $status);
    }

    protected function respondWithArray(array $array, int $status = 200)
    {
        $data = [
            'results' => $array,
            'status' => $status
        ];
        return response()->json($data, $status);
    }

    protected function respondWithItem(object $item, int $status = 200)
    {
        $item = new Item($item, $this->transformer);
        $itemTransformed = $this->fractal->createData($item)->toArray();

        $data = [
            'results' => $itemTransformed,
            'status'  => $status
        ];
        return response()->json($data, $status);
    }

    protected function respondWithCollection(object $item, int $status = 200)
    {
        $collection = new Collection($item, $this->transformer);
        $collectionTransformed = $this->fractal->createData($collection)->toArray();

        $data = [
            'results' => $collectionTransformed,
            'status'  => $status
        ];

        return response()->json($data);
    }
}
