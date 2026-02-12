<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryService
{

    public function getCategories(?string $search = null): LengthAwarePaginator;

    public function addCategory(array $data): Category;

    public function updateCategory(Category $category, array $data);

    public function removeCategory(Category $category): bool;
}
