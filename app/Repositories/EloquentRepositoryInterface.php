<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): ?Model;

    public function update(array $data, int $id): bool;

    public function delete(int $id): bool;

    public function find(int $id): ?Model;
}
