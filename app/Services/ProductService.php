<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductService
{
    public function getProducts(?string $search = null): LengthAwarePaginator;

    public function addProduct(array $data): Product;

    public function updateProduct(Product $product, array $data): bool;

    public function removeProduct(Product $product): bool;
}
