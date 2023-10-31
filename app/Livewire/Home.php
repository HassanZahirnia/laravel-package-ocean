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
            ->orderBy($this->sortSelectValue, 'desc')
            ->paginate(9);
    }

    public function totalPackagesCount()
    {
        return Package::query()->count();
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
}
