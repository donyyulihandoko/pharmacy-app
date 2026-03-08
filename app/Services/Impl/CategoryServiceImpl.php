<?php

namespace App\Services\Impl;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CategoryServiceImpl implements CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function getCategories(?string $search = null): LengthAwarePaginator
    {
        return $this->categoryRepository->getCategories($search);
    }


    private function handleIcon(?UploadedFile $file, ?string $oldPath = null): ?string
    {
        // Jika tidak ada file baru yang diupload
        if (!$file) {
            return $oldPath;
        }

        // Jika ada file lama (proses update), hapus dari storage
        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        // Simpan file baru dan kembalikan path-nya
        return $file->store('category-icons', 'public');
    }


    public function addCategory(array $data): Category
    {
        return DB::transaction(function () use ($data) {
            $data['icon'] = $this->handleIcon($data['icon'] ?? null);
            $created = $this->categoryRepository->createCategory($data);
            return $created;
        });
    }

    public function updateCategory(Category $category, array $data): bool
    {
        return DB::transaction(function () use ($category, $data) {
            $data['icon'] = $this->handleIcon($data['icon'] ?? null, $category->icon);
            $result = $this->categoryRepository->updateCategory($category, $data);
            return $result;
        });
    }

    public function removeCategory(Category $category): bool
    {
        return DB::transaction(function () use ($category) {
            $pathImage = $category->icon;
            $deleted = $this->categoryRepository->deleteCategory($category);

            if ($pathImage && $deleted) {
                Storage::disk('public')->delete($pathImage);
            }

            return (bool) $deleted;
        });
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAllCategories();
    }
}
