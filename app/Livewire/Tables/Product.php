<?php

namespace App\Livewire\Tables;

use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render(ProductService $productService)
    {
        return view('livewire.tables.product', [
            'products' => $productService->getProducts($this->search)
        ]);
    }
}
