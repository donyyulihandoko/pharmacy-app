<?php

namespace Tests\Feature\Admin;

use Exception;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        Storage::fake('public');
    }
    public function test_index_succes()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.categories.index'));
        $response->assertStatus(200);
    }

    public function test_index_failed_not_login()
    {
        $response = $this->get(route('admin.categories.index'));
        $response->assertStatus(302)->assertRedirectToRoute('login');
    }

    public function test_index_failed_wrong_role_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.index'));
        $response->assertStatus(403);
    }

    public function test_create_succes()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.categories.create'));
        $response->assertStatus(200);
    }

    public function test_create_failed_not_login()
    {
        $response = $this->get(route('admin.categories.create'));
        $response->assertStatus(302)->assertRedirectToRoute('login');
    }

    public function test_create_failed_wrong_role_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.create'));
        $response->assertStatus(403);
    }

    public function test_store_success()
    {
        $file = UploadedFile::fake()->image('category-test.jpg');

        $category = [
            'name' => 'Test Category',
            'description' => 'description test category',
            'icon' => $file,
            'is_active' => true
        ];
        $response = $this->actingAs($this->admin)->post(route('admin.categories.store'), $category);

        $response->assertStatus(302)
            ->assertRedirectToRoute('admin.categories.index')
            ->assertSessionHas('success', 'Category created successfully!');

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
            'description' => 'description test category',
            'is_active' => true
        ]);

        $categoryData = Category::where('name', 'Test Category')->first();
        $this->assertTrue(Storage::disk('public')->exists($categoryData->icon));
    }

    public function test_store_failed_empty_data()
    {
        $category = [
            'name' => '',
            'description' => '',
            'icon' => '',
            'is_active' => ''
        ];
        $response = $this->actingAs($this->admin)
            ->from(route('admin.categories.create'))
            ->post(route('admin.categories.store'), $category);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHasErrors([
                'name' => 'The name field is required.',
                'description' => 'The description field is required.',
                'icon' => 'The icon field is required.',
                'is_active' => 'The is active field must be true or false.'
            ]);
    }

    public function test_store_failed_duplicate_entry_data()
    {
        Category::factory()->create([
            'name' => 'Test Category'
        ]);

        $file = UploadedFile::fake()->image('category-test.jpg');

        $category = [
            'name' => 'Test Category',
            'description' => 'description test category',
            'icon' => $file,
            'is_active' => true
        ];

        $response = $this->actingAs($this->admin)
            ->from(route('admin.categories.create'))
            ->post(route('admin.categories.store'), $category);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHasErrors([
                'name' => 'The name has already been taken.',
            ]);
    }

    public function test_store_failed_throw_exception()
    {
        // set up data
        $file = UploadedFile::fake()->image('category-icon.jpg');
        $data = [
            'name' => 'Test Name',
            'icon' => $file,
            'description' => 'Desription Test',
            'is_active' => true,
        ];
        // set up mocking
        $this->mock(CategoryService::class, function ($mock) {
            $mock->shouldReceive('addCategory')
                ->once()
                ->andThrow(new Exception('Database error unexpected'));
        });


        $response = $this->actingAs($this->admin)
            ->from(route('admin.categories.create'))
            ->post(route('admin.categories.store'), $data);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('error', 'Category create failed!');
    }

    public function test_edit_success()
    {
        $category = Category::factory()->create();
        $response = $this->actingAs($this->admin)->get(route('admin.categories.edit', $category));
        $response->assertStatus(200);
    }

    public function test_edit_failed_not_wrong_role_user()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.edit', $category));
        $response->assertStatus(403);
    }

    public function test_edit_failed_not_login()
    {
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.edit', $category));
        $response->assertStatus(302)
            ->assertRedirectToRoute('login');
    }


    public function test_update_success_without_changing_image()
    {
        // setup existing data
        $initialPath = 'category-icons/existing-icon.jpg';
        $file = UploadedFile::fake()->image('existing-icon.jpg');
        $file->storeAs('category-icons', 'existing-icon.jpg', 'public');
        $category = Category::factory()->create([
            'name' => 'Test Category',
            'icon' => $initialPath,
            'description' => 'Kategori untuk berbagai macam suplemen.',
            'is_active'   => true,
        ]);

        // set up new data
        $data = [
            'name' => 'Test Category Update',
            'description' => 'Kategori untuk berbagai macam suplemen update.',
            'is_active'   => true,
        ];
        $response = $this->actingAs($this->admin)->put(route('admin.categories.update', $category), $data);

        // assertion
        $response->assertStatus(302)
            ->assertRedirectToRoute('admin.categories.index')
            ->assertSessionHas('success', 'Category updated successfully!');

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

    public function test_update_success_with_changing_image()
    {
        // set up existing category
        $initialPath = 'category-icons/existing-icon.jpg';
        $file = UploadedFile::fake()->image('existing-icon.jpg');
        $file->storeAs('category-icons', 'existing-icon.jpg', 'public');

        $category = Category::factory()->create([
            'name' => 'Existing Category',
            'description' => 'description category',
            'icon' => $initialPath,
            'is_active' => true
        ]);

        // set up update data
        $newImage = UploadedFile::fake()->image('new-icon.jpg');
        $data = [
            'name' => 'Existing Category Update',
            'description' => 'description category Update',
            'icon' => $newImage,
            'is_active' => true
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.categories.update', $category), $data);

        // asserting
        $response->assertStatus(302)
            ->assertRedirectToRoute('admin.categories.index')
            ->assertSessionHas('success', 'Category updated successfully!');

        $this->assertDatabaseHas('categories', [
            'name' => 'Existing Category Update',
            'description' => 'description category Update',
            'is_active' => true
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Existing Category',
            'description' => 'description category',
            'is_active' => true
        ]);

        $this->assertTrue(Storage::disk('public')->exists($category->refresh()->icon));
        $this->assertFalse(Storage::disk('public')->exists($initialPath));
    }

    public function test_update_failed_empty_data()
    {
        $category = Category::factory()->create();

        $response =  $this->actingAs($this->admin)
            ->from(route('admin.categories.edit', $category))
            ->put(route('admin.categories.update', $category), [
                'name' => '',
                'description' => '',
                'is_active' => ''
            ]);

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHasErrors([
                'name' => 'The name field is required.',
                'description' => 'The description field is required.',
                'is_active' => 'The is active field must be true or false.'
            ]);
    }

    public function test_update_failed_thow_exception()
    {
        // set up existing data
        $category = Category::factory()->create();

        // set up mocking
        $this->mock(CategoryService::class, function ($mock) {
            $mock->shouldReceive('updateCategory')
                ->once()
                ->andThrow(new Exception('Database error unexpected'));
        });

        // set up update data
        $response =  $this->actingAs($this->admin)
            ->from(route('admin.categories.edit', $category))
            ->put(route('admin.categories.update', $category), [
                'name' => 'Test Update',
                'description' => 'Description Test Update',
                'icon' => UploadedFile::fake('public')->image('test-icon.jpg'),
                'is_active' => true
            ]);

        // assertion
        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('error', 'Category update failed!');
    }

    public function test_destroy_success()
    {
        // set up existing data
        $existingImage = UploadedFile::fake()->image('category.jpg');
        $path = $existingImage->store('category-icons', 'public');
        $category = Category::factory()->create(['icon' => $path]);

        // set up delete data
        $response = $this->actingAs($this->admin)
            ->from(route('admin.categories.index'))
            ->delete(route('admin.categories.destroy', $category));

        // assert
        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('success', 'Category deleted successfully!');

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
        $this->assertFalse(Storage::disk('public')->exists($path));
    }

    public function test_destroy_failed_throw_exception()
    {
        $category = Category::factory()->create();

        $this->mock(CategoryService::class, function ($mock) {
            $mock->shouldReceive('removeCategory')
                ->once()
                ->andThrow(new Exception('Database error unexpected'));
        });

        $response = $this->actingAs($this->admin)
            ->from(route('admin.categories.index'))
            ->delete(route('admin.categories.destroy', $category));

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('error', 'Category delete failed!');
    }

    public function test_destroy_failed_categories_has_product()
    {
        $category = Category::factory()->create([
            'name' => 'test product'
        ]);

        Product::factory()->create([
            'category_id' => 1
        ]);

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.categories.destroy', $category));

        $response->assertStatus(302)
            ->assertRedirectBack()
            ->assertSessionHas('error', 'The category cannot be deleted because it still contains associated products.');
    }
}
