<?php

namespace App\Livewire;

use App\Models\Package;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TopLaravelPackagesHero extends Component
{
    #[Computed()]
    public function firstPlace()
    {
        // Return the first Laravel package that has the highest number of github stars.
        return Package::query()
            ->where('package_type', 'laravel-package')
            ->orderBy('stars', 'desc')
            ->first();
    }

    #[Computed()]
    public function secondPlace()
    {
        // Return the second Laravel package that has the highest number of github stars.
        return Package::query()
            ->where('package_type', 'laravel-package')
            ->orderBy('stars', 'desc')
            ->skip(1)
            ->first();
    }

    #[Computed()]
    public function thirdPlace()
    {
        // Return the third Laravel package that has the highest number of github stars.
        return Package::query()
            ->where('package_type', 'laravel-package')
            ->orderBy('stars', 'desc')
            ->skip(2)
            ->first();
    }

    public function render()
    {
        return view('livewire.top-laravel-packages-hero');
    }
}
