<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Product\CreateProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;
use App\Http\Transformers\ProductTransformer;
use App\Repositories\Eloquent\ProductRepository;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @property ProductRepository
     */
    private $repository;

    public function __construct(
        ProductTransformer $transformer,
        ProductRepository $repository,
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

    public function search($query)
    {
        $items = $this->repository->search($query);
        return $this->respondWithCollection($items);
    }

    public function getRandom()
    {
        $items = $this->repository->random();
        return $this->respondWithCollection($items);
    }

    public function show(int $id)
    {
        $item = $this->repository->find($id);
        return $this->respondWithItem($item);
    }

    public function getBySlug(string $slug)
    {
        $item = $this->repository->findBySlug($slug);
        return $this->respondWithItem($item);
    }


    public function create(CreateProductRequest $request)
    {
        $item = $this->repository->create($request->validated());
        return $this->respondWithItem($item, 201);
    }

    public function update(UpdateProductRequest $request)
    {
        $updated = $this->repository->update($request->validated(), $request->input('user_id'));

        if(!$updated)
            throw new Exception(__('controller.common.error_500'), 500);

        return $this->respondWithMessage(__('controller.user.updated'));
    }

    public function delete($id)
    {
        $deleted = $this->repository->delete($id);

        if(!$deleted)
            throw new Exception(__('controller.common.error_500'), 500);

        return $this->respondWithMessage(__('controller.user.deleted'));
    }
}
