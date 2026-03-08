<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductServiceImpl implements ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts(?string $search = null): LengthAwarePaginator
    {
        return $this->productRepository->getProducts($search);
    }

    private function handleImage(?UploadedFile $file, ?string $oldPath = null)
    {
        // no upload file
        if (!$file) return $oldPath;

        // jika ada file lama (update file)
        if ($oldPath) Storage::disk('public')->delete($oldPath);

        // simpam file baru
        return $file->store('product-images', 'public');
    }

    public function addProduct(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            $data['image'] = $this->handleImage($data['image'] ?? null);
            $result =  $this->productRepository->createProduct($data);
            return $result;
        });
    }

    public function updateProduct(Product $product, array $data): bool
    {
        return DB::transaction(function () use ($product, $data) {
            $data['image'] = $this->handleImage($data['image'] ?? null, $product->image);
            $result = $this->productRepository->updateProduct($product, $data);
            return $result;
        });
    }

    public function removeProduct(Product $product): bool
    {
        return DB::transaction(function () use ($product) {
            $pathImage = $product->image;
            $deleted = $this->productRepository->deleteProduct($product);

            if ($pathImage && $deleted) Storage::disk('public')->delete($pathImage);

            return (bool) $deleted;
        });
    }
}
