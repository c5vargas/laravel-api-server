<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface extends EloquentRepositoryInterface {

    public function getCustomers(): Collection;

    public function delete(int $id): bool;
}

