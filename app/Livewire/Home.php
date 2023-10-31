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

    #[Computed()]
    public function packages()
    {
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
            ->orderBy('first_release_at', 'desc')
            ->paginate(9);
    }

    public function totalPackagesCount()
    {
        return Package::query()->count();
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
