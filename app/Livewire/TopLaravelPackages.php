<?php

namespace App\Livewire;

use App\Models\Package;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class TopLaravelPackages extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    public $alpinePackagesTotal = 0;

    public $alpineCurrentPage = 0;

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
    public function packages()
    {
        $result = Package::query()
            ->when($this->search, function (Builder $query, string $search) {
                $query
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('keywords', 'LIKE', "%{$search}%");
            })
            ->when($this->showOfficialPackages, function (Builder $query) {
                $query->where('author', 'laravel');
            })
            ->when($this->selectedCategory, function (Builder $query, string $category) {
                $query->whereHas('category', function (Builder $query) use ($category) {
                    $query->where('name', $category);
                });
            })
            // If lastVisitDate isn't null, then only show packages that have been released since lastVisitDate (created_at)
            ->when($this->showNewPackagesSinceLastVisit && $this->lastVisitDate, function (Builder $query) {
                $query->where('created_at', '>=', $this->lastVisitDate);
            })
            ->orderBy($this->sortSelectValue, 'desc')
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
            title: 'Laravel Package Ocean - Top Laravel packages',
            description: 'The most popular Laravel packages with the highest stars on Github.',
            url: route('top-laravel-packages'),
            image: route('home').'/laravel-package-ocean-opengraph.webp',
        ));

        return view('livewire.top-laravel-packages');
    }
}
