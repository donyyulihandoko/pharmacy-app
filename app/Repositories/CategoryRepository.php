<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepository
{
    public function getCategories(?string $search = null): LengthAwarePaginator;

    public function createCategory(array $data): Category;

    public function updateCategory(Category $category, array $data): bool;

    public function deleteCategory(Category $category): bool;
}
