<?php

namespace App\Livewire\Tables;

use App\Services\CategoryService;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render(CategoryService $categoryService)
    {
        return view('livewire.tables.category', [
            'categories' => $categoryService->getCategories($this->search)
        ]);
    }
}
