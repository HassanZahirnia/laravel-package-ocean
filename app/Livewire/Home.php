<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Package;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    #[Url(as: 'category', history: true)]
    public $selectedCategory = '';

    #[Url(as: 'official', history: true)]
    public $showOfficialPackages = false;

    #[Url(history: true)]
    public $search = '';

    #[Url(as: 'sort', history: true)]
    public $sortSelectValue = 'first_release_at';

    public $lastVisitDate = null;

    public $showNewPackagesSinceLastVisit = false;

    #[Computed()]
    public function packages()
    {
        // If the $this->sortSelectValue is not in the $this->sortSelectItems(), then default to 'first_release_at'
        $this->sortSelectValue = collect($this->sortSelectItems())
            ->pluck('value')
            ->contains($this->sortSelectValue)
            ? $this->sortSelectValue
            : 'first_release_at';

        // If the $this->selectedCategory is not in the $this->categoriesSelectItems(), then default to ''
        $this->selectedCategory = collect($this->categoriesSelectItems())
            ->pluck('value')
            ->contains($this->selectedCategory)
            ? $this->selectedCategory
            : '';

        // If the $this->showOfficialPackages is not a boolean, then default to false
        $this->showOfficialPackages = is_bool($this->showOfficialPackages)
            ? $this->showOfficialPackages
            : false;

        return Package::query()
            ->when($this->search, function (Builder $query, string $search) {
                $query->where('name', 'LIKE', "%{$search}%");
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
    }

    public function totalPackagesCount(): int
    {
        return Package::query()->count();
    }

    // Show number of new packages since the last visit if lastVisitDate is not null, and if it's null, show 0
    public function newPackagesCountSinceLastVisit(): int
    {
        if ($this->lastVisitDate === null) {
            return 0;
        }

        return Package::query()
            ->when($this->lastVisitDate, function (Builder $query) {
                $query->where('created_at', '>=', $this->lastVisitDate);
            })
            ->count();
    }

    public function sortSelectItems(): array
    {
        return [
            [
                'label' => 'Newest',
                'value' => 'first_release_at',
                'detail' => 'Freshly Released',
            ],
            [
                'label' => 'Most Stars',
                'value' => 'stars',
                'detail' => 'Popular',
            ],
            [
                'label' => 'Recently Added',
                'value' => 'created_at',
                'detail' => 'Latest Additions',
            ],
            [
                'label' => 'Latest Release',
                'value' => 'latest_release_at',
                'detail' => 'Recent Versions',
            ],
        ];
    }

    public function categoriesSelectItems(): array
    {
        return [
            [
                'label' => 'All Categories',
                'value' => '',
                'detail' => $this->totalPackagesCount().' Packages',
            ],
            // List of categories with packages count
            ...$this->categories()->map(function (Category $category) {
                return [
                    'label' => $category->name,
                    'value' => $category->name,
                    'detail' => $category->packages_count.' Packages',
                ];
            }),
        ];
    }

    #[Computed()]
    public function categories()
    {
        // Return categories with packages count
        return Category::query()
            ->orderBy('id', 'asc')
            ->withCount('packages')
            ->get();
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function setShowOfficialPackages($value)
    {
        $this->showOfficialPackages = $value;
    }

    // Toggle showOfficialPackages
    public function toggleShowOfficialPackages()
    {
        $this->showOfficialPackages = ! $this->showOfficialPackages;
    }

    // Toggle showNewPackagesSinceLastVisit
    public function toggleShowNewPackagesSinceLastVisit()
    {
        $this->showNewPackagesSinceLastVisit = ! $this->showNewPackagesSinceLastVisit;
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
        return view('livewire.home');
    }

    public function updatingPage($page)
    {
        $this->js("document.querySelector('#scroll-to-reference')?.scrollIntoView({ behavior: 'auto' })");
    }
}
