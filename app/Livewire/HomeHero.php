<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Package;
use Livewire\Component;

class HomeHero extends Component
{
    public function render()
    {
        return view('livewire.home-hero', [
            'stats' => [
                'packages' => Package::count(),
                'authors' => Package::distinct('author')->count('author'),
                'categories' => Category::count(),
            ],
        ]);
    }
}
