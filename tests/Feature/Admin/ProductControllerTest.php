<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        Category::factory(50)->create();
        $this->admin = User::factory()->admin()->create();
        Storage::fake('public');
    }

    public function test_index_succes()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.products.index'));
        $response->assertStatus(200);
    }

    public function test_index_failed_not_login()
    {
        $response = $this->get(route('admin.products.index'));
        $response->assertStatus(302)->assertRedirectToRoute('login');
    }

    public function test_index_failed_wrong_role_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.products.index'));
        $response->assertStatus(403);
    }

    public function test_create_succes()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.products.create'));
        $response->assertStatus(200);
    }

    public function test_create_failed_not_login()
    {
        $response = $this->get(route('admin.products.create'));
        $response->assertStatus(302)->assertRedirectToRoute('login');
    }

    public function test_create_failed_wrong_role_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.products.create'));
        $response->assertStatus(403);
    }

    public function test_store_success()
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

        $response = $this->actingAs($this->admin)->post(route('admin.products.store'), $data);

        $response->assertStatus(302)
            ->assertRedirectToRoute('admin.products.index')
            ->assertSessionHas('success', 'Product created successfully!');

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        $productData = Product::where('name', 'Test Product')->first();
        $this->assertTrue(Storage::disk('public')->exists($productData->image));
    }

    public function test_store_failed_empty_data()
    {
        $data = [
            'name' => '',
            'slug' => '',
            'image' => '',
            'price' => '',
            'about' => '',
            'category_id' => ''
        ];

        $response = $this->actingAs($this->admin)
            ->from(route('admin.products.index'))
            ->post(route('admin.products.store'), $data);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHasErrors([
                'name' => 'The name field is required.',
                'image' => 'The image field is required.',
                'price' => 'The price field is required.',
                'about' => 'The about field is required.',
                'category_id' => 'The category id field is required.',
            ]);
    }

    public function test_store_failed_duplicate_data_name()
    {
        Product::factory()->create(['name' => 'Paracetamol']);
        $file = UploadedFile::fake()->create('product-test.jpg');
        $data = [
            'name' => 'Paracetamol',
            'slug' => 'paracetamol',
            'image' => $file,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ];

        $response = $this->actingAs($this->admin)
            ->from(route('admin.products.index'))
            ->post(route('admin.products.store'), $data);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHasErrors([
                'name' => 'The name has already been taken.',
            ]);
    }

    public function test_store_failed_throw_exception()
    {
        $file = UploadedFile::fake()->create('product-test.jpg');
        $data = [
            'name' => 'Paracetamol',
            'slug' => 'paracetamol',
            'image' => $file,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ];

        $this->mock(ProductService::class, function ($mock) {
            $mock->shouldReceive('addProduct')
                ->once()
                ->andThrow(new Exception('Database error unexpected'));
        });

        $response = $this->actingAs($this->admin)
            ->from(route('admin.products.index'))
            ->post(route('admin.products.store'), $data);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('error', 'Product create failed!');
    }

    public function test_update_product_success_without_changing_image()
    {
        // set up existing data
        $existingImage = 'product-images/test-product.jpg';
        $file = UploadedFile::fake()->image('test-product.jpg');
        $file->storeAs('product-images', 'test-product.jpg', 'public');

        $product = Product::factory()->create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => $existingImage,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        // set up update data
        $data = [
            'name' => 'Test Product Update',
            'slug' => 'test-product-update',
            'price' => 100_000,
            'about' => 'Description test product update',
            'category_id' => 4,
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.products.update', $product), $data);

        // asserting
        $response->assertStatus(302)
            ->assertRedirectToRoute('admin.products.index')
            ->assertSessionHas('success', 'Product updated successfully!');

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

        $this->assertTrue(Storage::disk('public')->exists($existingImage));
    }

    public function test_update_product_success_with_changing_image()
    {
        // set up existing data
        $oldImage = 'product-images/test-product.jpg';
        $file = UploadedFile::fake()->image('test-product.jpg');
        $file->storeAs('product-images', 'test-product.jpg', 'public');

        $product = Product::factory()->create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'image' => $oldImage,
            'price' => 10_000,
            'about' => 'Description test product',
            'category_id' => 20,
        ]);

        // set up update data
        $newImage = UploadedFile::fake()->image('new-image.jpg');
        $data = [
            'name' => 'Test Product Update',
            'slug' => 'test-product-update',
            'price' => 100_000,
            'image' => $newImage,
            'about' => 'Description test product update',
            'category_id' => 4,
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.products.update', $product), $data);

        // asserting
        $response->assertStatus(302)
            ->assertRedirectToRoute('admin.products.index')
            ->assertSessionHas('success', 'Product updated successfully!');

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

    public function test_update_failed_empty_data()
    {
        $product = Product::factory()->create();
        $response = $this->actingAs($this->admin)->from(route('admin.products.index'))
            ->put(route('admin.products.update', $product), [
                'name' => '',
                'slug' => '',
                'image' => '',
                'price' => '',
                'about' => '',
                'category_id' => ''
            ]);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHasErrors([
                'name' => 'The name field is required.',
                'price' => 'The price field is required.',
                'about' => 'The about field is required.',
                'category_id' => 'The category id field is required.',
            ]);
    }

    public function test_update_failed_thow_exception()
    {
        $product = Product::factory()->create();

        $this->mock(ProductService::class, function ($mock) {
            $mock->shouldReceive('updateProduct')
                ->once()
                ->andThrow(new Exception('Database error unexpected'));
        });

        $response = $this->actingAs($this->admin)->from(route('admin.products.index'))
            ->put(route('admin.products.update', $product), [
                'name' => 'Test Product Update',
                'slug' => 'test-product-update',
                'price' => 100_000,
                'about' => 'Description test product update',
                'category_id' => 4,
            ]);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('error', 'Product update failed!');
    }

    public function test_destroy_success()
    {
        $existingImage = UploadedFile::fake()->image('product.jpg');
        $path = $existingImage->store('product-images', 'public');
        $product = Product::factory()->create(['image' => $path]);

        $response = $this->actingAs($this->admin)->delete(route('admin.products.destroy', $product));

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('success', 'Product deleted successfully!');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertFalse(Storage::disk('public')->exists($path));
    }

    public function test_destroy_failed_throw_exception()
    {
        $product = Product::factory()->create();
        $this->mock(ProductService::class, function ($mock) {
            $mock->shouldReceive('removeProduct')
                ->once()
                ->andThrow(new Exception('Database error unexpected'));
        });
        $response = $this->actingAs($this->admin)->delete(route('admin.products.destroy', $product));
        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('error', 'Product delete failed!');
    }
}
