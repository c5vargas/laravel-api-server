<?php

namespace App\Http\Controllers;

use App\Http\Transformers\CategoryTransformer;
use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @property CategoryRepository
     */
    private $repository;

    public function __construct(
        CategoryTransformer $transformer,
        CategoryRepository $repository,
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

    public function getFeatured()
    {
        $items = $this->repository->featured();
        return $this->respondWithCollection($items);
    }

    public function show(int $id)
    {
        $item = $this->repository->find($id);
        return $this->respondWithItem($item);
    }
}
