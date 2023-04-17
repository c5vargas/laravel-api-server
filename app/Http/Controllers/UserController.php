<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Users\UserCreateRequest;
use App\Http\Requests\Api\Users\UserUpdateRequest;
use App\Http\Transformers\UserTransformer;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @property UserRepositoryInterface
     */
    private $repository;

    public function __construct(
        UserTransformer $transformer,
        UserRepositoryInterface $repository,
        Request $request
    ){
        parent::__construct($transformer, $request);
        $this->repository = $repository;
    }

    /**
     * This function retrieves a list of customers and returns it as a collection.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->repository->getCustomers();
        return $this->respondWithCollection($users);
    }

    /**
     * This PHP function retrieves a user by their ID and returns a response with the user's
     * information.
     *
     * @param int id The parameter "id" is an integer that represents the unique identifier of the user
     * that we want to retrieve from the database.
     *
     * @return Response
     */
    public function show(int $id)
    {
        $user = $this->repository->find($id);
        return $this->respondWithItem($user);
    }

    /**
     * This PHP function creates a new user and returns a response with the created user's data.
     *
     * @param UserCreateRequest $request
     *
     * @return Response
     */
    public function create(UserCreateRequest $request)
    {
        $user = $this->repository->create($request->validated());
        return $this->respondWithItem($user, 201);
    }

    /**
     * This function updates a user's information and returns a success message or throws an exception
     * if the update fails.
     *
     * @param UserUpdateRequest $request
     *
     * @return Response
     */
    public function update(UserUpdateRequest $request)
    {
        $updated = $this->repository->update($request->validated(), $request->input('user_id'));

        if(!$updated)
            throw new Exception(__('controller.common.error_500'), 500);

        return $this->respondWithMessage(__('controller.user.updated'));
    }

    /**
     * This function deletes a user with a given ID and returns a success message, or throws an
     * exception if the deletion fails.
     *
     * @param id The parameter `id` is the unique identifier of the record that needs to be deleted
     * from the database. It is passed as an argument to the `delete()` function.
     *
     * @return Response
     */
    public function delete($id)
    {
        $deleted = $this->repository->delete($id);

        if(!$deleted)
            throw new Exception(__('controller.common.error_500'), 500);

        return $this->respondWithMessage(__('controller.user.deleted'));
    }
}
