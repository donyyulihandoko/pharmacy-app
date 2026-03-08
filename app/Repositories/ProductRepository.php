<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepository
{
    public function getProducts(?string $search = null): LengthAwarePaginator;

    public function createProduct(array $data): Product;

    public function updateProduct(Product $product, array $data): bool;

    public function deleteProduct(Product $product): bool;
}
