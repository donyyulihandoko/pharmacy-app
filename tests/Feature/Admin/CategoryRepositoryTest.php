<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private CategoryRepository $categoryRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categoryRepository = $this->app->make(CategoryRepository::class);
    }

    public function test_service_container_not_null()
    {
        $this->assertNotNull($this->categoryRepository);
    }

    public function test_get_categories()
    {
        Category::factory(15)->create();
        $response = $this->categoryRepository->getCategories();
        $this->assertCount(10, $response);
        $this->assertEquals(15, $response->total());
    }

    public function test_create_category()
    {
        $category = [
            'name' => 'Test Category',
            'icon' => 'category-icons/sample.png', // String path
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ];

        $this->categoryRepository->createCategory($category);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
            'slug' => 'test-category',

        ]);
    }

    public function test_update_category()
    {
        $category = Category::factory()->create([
            'name' => 'Test Category',
            'icon' => 'category-icons/sample.png', // String path
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);

        $data = [
            'name' => 'Test Category Update',
            'icon' => 'category-icons/sample-update.png', // String path
            'description' => 'Kategori untuk berbagai macam suplemen update.',
            'is_active'   => true,
        ];

        $this->categoryRepository->updateCategory($category, $data);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category Update',
            'slug' => 'test-category-update',
            'description' => 'Kategori untuk berbagai macam suplemen update.',
            'is_active'   => true,
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);
    }

    public function test_delete_category()
    {
        $category = Category::factory()->create([
            'name' => 'Test Category',
            'icon' => 'category-icons/sample.png', // String path
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);

        $this->categoryRepository->deleteCategory($category);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);
    }
}
