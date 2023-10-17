<?php

namespace App\Livewire;

use Livewire\Component;

class CategoryList extends Component
{
    public function render()
    {
        return view('livewire.category-list', [
            'categories' => \App\Models\Category::all(),
        ]);
    }
}
