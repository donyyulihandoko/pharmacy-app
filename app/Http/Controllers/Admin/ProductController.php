<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private CategoryService $categoryService;
    private ProductService $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }


    public function index(): Response
    {
        return response()->view('admin.product.index');
    }


    public function create(): Response
    {
        return response()->view('admin.product.create', [
            'categories' => $this->categoryService->getAllCategories()
        ]);
    }


    public function store(StoreProductRequest $request): RedirectResponse
    {
        try {
            Log::info('Product created success', [
                'payload' => $request->except('image'),
                'user_id' => Auth::id()
            ]);
            $this->productService->addProduct($request->validated());
            return to_route('admin.products.index')->with('success', 'Product created successfully!');
        } catch (Exception $e) {
            Log::error('Product created failed : ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Product create failed!');
        };
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Product $product): Response
    {
        return response()->view('admin.product.edit', [
            'product' => $product,
            'categories' => $this->categoryService->getAllCategories()
        ]);
    }


    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        try {
            Log::info('Product updated successfully!', [
                'payload' => $request->except('image'),
                'user_id' => Auth::id()
            ]);
            $this->productService->updateProduct($product, $request->validated());
            return to_route('admin.products.index')->with('success', 'Product updated successfully!');
        } catch (Exception $e) {
            Log::error('Product update failed! : ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Product update failed!');
        }
    }


    public function destroy(Product $product): RedirectResponse
    {
        try {
            Log::info('Product deleted successfully!', [
                'deleted' => $product->id,
                'user' => Auth::id()
            ]);
            $this->productService->removeProduct($product);
            return redirect()->back()->with('success', 'Product deleted successfully!');
        } catch (Exception $e) {
            Log::error('Product deleted failed : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Product delete failed!');
        }
    }
}
