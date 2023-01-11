<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve a Model by ID
     *
     * @param string $id
     *
     * @return Model
     */
    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Retrieve all Models
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Create a new Model
     *
     * @param Array $data
     *
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update a Model
     *
     * @param Array $data
     *
     * @return Model
     */
    public function update(array $data, int $id): bool
    {
        $model = $this->find($id);
        return $model->update($data);
    }

    /**
     * Delete a Model
     *
     * @param string $id
     *
     * @return boolean
     */
    public function delete(int $id): bool
    {
        $model = $this->find($id);
        if(!$model) return false;

        return $model->delete();
    }

}
