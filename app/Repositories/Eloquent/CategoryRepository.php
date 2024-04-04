<?php
namespace App\Repositories\Eloquent;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    protected $model;

    /**
     * CategoryRepository constructor.
     *
     * @param Category $user
     */
    public function __construct(Category $item)
    {
        $this->model = $item;
    }

    public function featured()
    {
        return $this->model->where('featured', true)->get();
    }
}
