<?php
namespace App\Repositories\Eloquent;

use App\Models\Brand;

class BrandRepository extends BaseRepository
{
    protected $model;

    /**
     * BrandRepository constructor.
     *
     * @param Brand $user
     */
    public function __construct(Brand $item)
    {
        $this->model = $item;
    }
}
