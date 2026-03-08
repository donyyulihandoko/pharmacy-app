<?php

namespace App\Repositories\Impl;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepositoryImpl implements ProductRepository
{
    public function getProducts(?string $search = null): LengthAwarePaginator
    {
        return Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like',  "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    public function deleteProduct(Product $product): bool
    {
        return $product->delete();
    }
}
