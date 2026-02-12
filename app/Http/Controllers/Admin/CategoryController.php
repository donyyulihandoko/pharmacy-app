<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): Response
    {
        return response()->view('admin.category.index');
    }

    public function create(): Response
    {
        return response()->view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        try {
            Log::info('Category created successfully', [
                'payload' => $request->except('icon'),
                'user' => Auth::id()
            ]);
            $this->categoryService->addCategory($request->validated());
            return to_route('categories.index')->with('success', 'Category created successfully!');
        } catch (Exception $e) {
            Log::error('Category create failed : ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Category create failed!');
        }
    }

    public function edit(Category $category): Response
    {
        return response()->view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        try {
            Log::info('Category updated successfully', [
                'payload' => $request->except('icon'),
                'user' => Auth::id()
            ]);
            $this->categoryService->updateCategory($category, $request->validated());
            return to_route('categories.index')->with('success', 'Category updated successfully!');
        } catch (Exception $e) {
            Log::error('Category update failed : ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Category update failed!');
        }
    }

    public function destroy(Category $category)
    {
        try {
            Log::info('Category deleted successfully', [
                'category_id' => $category->id,
                'user' => Auth::id()
            ]);
            $this->categoryService->removeCategory($category);
            return redirect()->back()->with('success', 'Category deleted successfully!');
        } catch (Exception $e) {
            Log::error('Category delete failed : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Category delete failed!');
        }
    }
}
