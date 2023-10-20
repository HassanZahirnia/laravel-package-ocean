<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

class PackageList extends Component
{
    #[Url(history: true)]
    public $search = '';

    public function render()
    {
        return view('livewire.package-list');
    }
}
