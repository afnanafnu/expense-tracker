<?php

namespace App\Repositories\Admin\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function query()
    {
        return Category::query()->latest();
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): Category
    {
        $category = Category::findOrFail($id);

        $category->update($data);

        return $category;
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}