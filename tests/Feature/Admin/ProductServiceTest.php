<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;
    private ProductService $productService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = $this->app->make(ProductService::class);
        Category::factory(50)->create();
        Storage::fake('public');
    }

    public function test_service_container_not_null()
    {
        $this->assertNotNull($this->productService);
    }

    public function test_get_products()
    {
        Product::factory(10)->create();
        $result = $this->productService->getProducts();
        $this->assertNotNull($result);
        $this->assertEquals(10, $result->total());
    }

    public function test_get_products_with_search()
    {
        Product::factory()->create([
            'name' => 'Paracetamol 500mg'
        ]);

        $result =  $this->productService->getProducts('Paracetamol 500mg');
        $this->assertCount(1, $result);
        $this->assertEquals('Paracetamol 500mg', $result->first()->name);
    }

    public function test_add_product_success()
    {
        $file = UploadedFile::fake()->create('product-test.jpg');
        $data = [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => $file,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ];

        $result = $this->productService->addProduct($data);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);
        $this->assertEquals($data['name'], $result->name);
        $this->assertTrue(Storage::disk('public')->exists($result->image));
    }

    public function test_add_category_failed_validation_error()
    {
        $this->expectException(Exception::class);
        $this->productService->addProduct([
            'name' => null
        ]);
    }

    public function test_update_product_success_without_changing_image()
    {
        // set up initial image
        $existingImage = 'product-images/test-image.jpeg';
        $file = UploadedFile::fake()->image('test-image.jpeg');
        $file->storeAs('product-images', 'test-image.jpeg', 'public');

        // set up old data
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => $existingImage,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        // set up  update data
        $updateData = [
            'name' => 'Test Product Update',
            'slug' => 'test-product-update',
            'price' => 100_000,
            'about' => 'Description test product update',
            'category_id' => 4,
        ];

        $this->productService->updateProduct($product, $updateData);

        // assertion
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product Update',
            'slug' => 'test-product-update',
            'price' => 100_000,
            'about' => 'Description test product update',
            'category_id' => 4,
        ]);

        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);
        $product->refresh();
        $this->assertEquals($existingImage, $product->image);
        $this->assertTrue(Storage::disk('public')->exists($existingImage));
    }

    public function test_update_product_success_with_changing_image()
    {
        // set up old image
        $oldImage = 'product-images/old-image.jpeg';
        $file = UploadedFile::fake()->image('old-image.jpeg');
        $file->storeAs('product-images', 'old-image.jpeg', 'public');

        // set up old data
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => $oldImage,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        // set up  update data
        $newImage = UploadedFile::fake()->create('new-image.jpeg');
        $updateData = [
            'name' => 'Test Product Update',
            'slug' => 'test-product-update',
            'image' => $newImage,
            'price' => 100_000,
            'about' => 'Description test product update',
            'category_id' => 4,
        ];

        $this->productService->updateProduct($product, $updateData);

        // assertion
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product Update',
            'slug' => 'test-product-update',
            'price' => 100_000,
            'about' => 'Description test product update',
            'category_id' => 4,
        ]);

        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        $this->assertTrue(Storage::disk('public')->exists($product->refresh()->image));
        $this->assertFalse(Storage::disk('public')->exists($oldImage));
    }

    public function test_update_product_throw_validation_error()
    {
        $product = Product::factory()->create();

        $this->expectException(Exception::class);
        $this->productService->updateProduct($product, [
            'name' => null
        ]);
    }

    public function test_remove_product_success()
    {
        $existingImage = 'product-images/test-image.jpeg';
        $file = UploadedFile::fake()->image('test-image.jpeg');
        $file->storeAs('product-images', 'test-image.jpeg', 'public');
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => $existingImage,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        $this->productService->removeProduct($product);

        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => $existingImage,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        $this->assertFalse(Storage::disk('public')->exists($existingImage));
    }
}
