<?php

namespace App\Livewire;

use App\Models\Package;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Leaderboard extends Component
{
    use WithPagination;

    #[Title('Top Best Laravel Packages')]

    #[Url(history: true)]
    public $search = '';

    public $alpinePackagesTotal = 0;

    public $alpineCurrentPage = 0;

    #[Computed()]
    public function packages()
    {
        $firstThreePackages = Package::query()
            ->where('package_type', 'laravel-package')
            ->orderBy('stars', 'desc')
            ->limit(3)
            ->get();

        $result = Package::query()
            ->where('package_type', 'laravel-package')
            ->when($this->search, function (Builder $query, string $search) {
                $query
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('keywords', 'LIKE', "%{$search}%");
            })
            ->orderBy('stars', 'desc')
            ->whereNotIn('id', $firstThreePackages->pluck('id'))
            ->paginate(9);

        $this->alpinePackagesTotal = $result->total();
        $this->alpineCurrentPage = $result->currentPage();

        return $result;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function render()
    {
        view()->share('SEOData', new SEOData(
            title: 'Laravel Package Ocean - Top Best Laravel packages',
            description: 'The most popular Laravel packages with the highest stars on Github.',
            url: route('leaderboard'),
            image: route('home').'/laravel-package-ocean-opengraph.webp',
        ));

        return view('livewire.leaderboard');
    }
}
