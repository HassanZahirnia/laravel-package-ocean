<div class="hidden w-full max-w-[15rem] sm:block sm:pb-20">
    {{-- Category title --}}
    <div class="flex min-h-[3rem] items-center">
        <div class="text-2xl font-semibold transition duration-300">
            Categories
        </div>
    </div>
    {{-- Category list --}}
    <div class="w-full pt-4">
        @foreach ($this->categories as $category)
            <div wire:key="{{ $category->name }}">
                <x-packages.category :$category />
            </div>
        @endforeach
    </div>
</div>
