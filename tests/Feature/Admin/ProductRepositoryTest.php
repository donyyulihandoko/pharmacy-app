<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        Category::factory(50)->create();
        $this->productRepository = $this->app->make(ProductRepository::class);
    }

    public function test_service_container_not_null()
    {
        $this->assertNotNull($this->productRepository);
    }

    public function test_get_products()
    {
        Product::factory(20)->create();
        $result =  $this->productRepository->getProducts();
        $this->assertCount(10, $result);
        $this->assertEquals(20, $result->total());
    }

    public function test_create_product()
    {
        $data = [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => 'product-images/test.jpg',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ];
        $result = $this->productRepository->createProduct($data);

        $this->assertNotNull($result);
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => 'product-images/test.jpg',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);
    }

    public function test_update_product()
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => 'product-images/test.jpg',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        $updateData = [
            'name' => 'Test Product Update',
            'slug' => 'test-product-update',
            'image' => 'product-images/test-update.jpg',
            'price' => 100_000,
            'about' => 'Description test product update',
            'category_id' => 4,
        ];

        $this->productRepository->updateProduct($product, $updateData);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product Update',
            'slug' => 'test-product-update',
            'image' => 'product-images/test-update.jpg',
            'price' => 100_000,
            'about' => 'Description test product update',
            'category_id' => 4,
        ]);

        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => 'product-images/test.jpg',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);
    }

    public function test_delete_product()
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => 'product-images/test.jpg',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        $this->productRepository->deleteProduct($product);

        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => 'product-images/test.jpg',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);
    }
}
