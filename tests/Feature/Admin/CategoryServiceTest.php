<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use Exception;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    private CategoryService $categoryService;

    public function setUp(): void
    {
        parent::setUp();
        $this->categoryService = $this->app->make(CategoryService::class);
        Storage::fake('public');
    }

    public function test_service_container_not_null()
    {
        $this->assertNotNull($this->categoryService);
    }

    public function test_get_categories()
    {
        Category::factory(10)->create();
        $response = $this->categoryService->getCategories();
        $this->assertNotNull($response);
        $this->assertEquals(10, $response->total());
    }

    public function test_get_categories_with_search()
    {
        Category::factory()->create([
            'name' => 'Pain Killer'
        ]);
        Category::factory()->create([
            'name' => 'Anestesi'
        ]);

        $response = $this->categoryService->getCategories('anestesi');
        $this->assertCount(1, $response);
        $this->assertEquals('Anestesi', $response->first()->name);
    }

    public function test_add_category_success()
    {
        $file = UploadedFile::fake()->image('category-test.jpg');

        $category = [
            'name' => 'Test Category',
            'description' => 'description test category',
            'icon' => $file,
            'is_active' => true
        ];

        $result = $this->categoryService->addCategory($category);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'description test category',
        ]);

        $this->assertEquals($category['name'], $result->name);
        $this->assertEquals($category['description'], $result->description);
        $this->assertTrue(Storage::disk('public')->exists($result->icon));
    }

    public function test_add_category_throw_validation_error()
    {
        $this->expectException(Exception::class);
        $this->categoryService->addCategory([
            'slug' => 'without-name'
        ]);
    }

    public function test_update_category_success_without_changing_icon()
    {
        $initialPath = 'category-icons/existing-icon.jpg';
        $file = UploadedFile::fake()->image('existing-icon.jpg');
        $file->storeAs('category-icons', 'existing-icon.jpg', 'public');

        $category = Category::factory()->create([
            'name' => 'Test Category',
            'icon' => $initialPath,
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,

        ]);

        $data = [
            'name' => 'Test Category Update',
            'description' => 'Kategori untuk berbagai macam suplemen update.',
            'is_active'   => true,
        ];

        $this->categoryService->updateCategory($category, $data);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category Update',
            'description' => 'Kategori untuk berbagai macam suplemen update.',
            'is_active'   => true,
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Test Category',
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);

        $category->refresh();
        $this->assertEquals($data['name'], $category->name);
        $this->assertEquals($data['description'], $category->description);
        $this->assertEquals($initialPath, $category->icon);
        $this->assertTrue(Storage::disk('public')->exists($initialPath));
    }

    public function test_update_category_succes_with_changing_icon()
    {
        $oldPath = 'category-icons/existing-icon.jpg';
        $file = UploadedFile::fake()->image('existing-icon.jpg');
        $file->storeAs('category-icons', 'existing-icon.jpg', 'public');

        $category = Category::factory()->create([
            'name' => 'Test Category',
            'icon' => $oldPath,
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);

        $newImage = UploadedFile::fake()->image('new-icon.jpg');
        $data = [
            'name' => 'Test Category Update',
            'icon' => $newImage,
            'description' => 'Kategori untuk berbagai macam suplemen update.',
            'is_active'   => true,
        ];

        $this->categoryService->updateCategory($category, $data);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category Update',
            'description' => 'Kategori untuk berbagai macam suplemen update.',
            'is_active'   => true,
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Test Category',
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);
        $category->refresh();
        $this->assertEquals($data['name'], $category->name);
        $this->assertEquals($data['description'], $category->description);
        $this->assertTrue(Storage::disk('public')->exists($category->refresh()->icon));
        $this->assertFalse(Storage::disk('public')->exists($oldPath));
    }

    public function test_update_category_throw_validation_error()
    {
        $category = Category::factory()->create();

        $this->expectException(Exception::class);
        $this->categoryService->updateCategory($category, [
            'name' => null
        ]);
    }

    public function test_remove_categories()
    {
        $initialPath = 'category-icons/existing-icon.jpg';
        $file = UploadedFile::fake()->image('existing-icon.jpg');
        $file->storeAs('category-icons', 'existing-icon.jpg', 'public');

        $category = Category::factory()->create([
            'name' => 'Test Category',
            'icon' => $initialPath,
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,

        ]);

        $this->categoryService->removeCategory($category);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Test Category',
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);

        $this->assertFalse(Storage::disk('public')->exists($initialPath));
    }
}
