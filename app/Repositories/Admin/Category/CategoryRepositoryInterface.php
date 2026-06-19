<?php

namespace App\Repositories\Admin\Category;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function query();

    public function create(array $data): Category;

    public function update(int $id, array $data): Category;

    public function delete(Category $category): bool;
}