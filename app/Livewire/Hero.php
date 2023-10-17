<?php

namespace App\Livewire;

use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        return view('livewire.hero', [
            'laravelPackagesCount' => 0,
            'authorsCount' => 0,
            'categoriesCount' => 0,
        ]);
    }
}
