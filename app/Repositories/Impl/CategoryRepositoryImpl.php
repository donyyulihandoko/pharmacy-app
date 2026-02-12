<?php

namespace App\Repositories\Impl;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepositoryImpl implements CategoryRepository
{
    public function getCategories(?string $search = null): LengthAwarePaginator
    {
        return Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function createCategory(array $data): Category
    {
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): bool
    {
        return $category->update($data);
    }

    public function deleteCategory(Category $category): bool
    {
        return $category->delete();
    }
}
