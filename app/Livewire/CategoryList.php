<?php

namespace App\Livewire;

use Livewire\Component;

class CategoryList extends Component
{
    public $selectedCategory = null;

    public function render()
    {
        return view('livewire.category-list', [
            'categories' => \App\Models\Category::all(),
        ]);
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
    }
}
