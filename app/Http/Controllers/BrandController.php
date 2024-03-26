<?php

namespace App\Http\Controllers;

use App\Http\Transformers\BrandTransformer;
use App\Repositories\Eloquent\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{
/**
     * @property BrandRepository
     */
    private $repository;

    public function __construct(
        BrandTransformer $transformer,
        BrandRepository $repository,
        Request $request
    ){
        parent::__construct($transformer, $request);
        $this->repository = $repository;
    }

    public function index()
    {
        $items = $this->repository->all();
        return $this->respondWithCollection($items);
    }

    public function show(int $id)
    {
        $item = $this->repository->find($id);
        return $this->respondWithItem($item);
    }
}
