<div class="hidden w-full max-w-[15rem] sm:block sm:pb-20">
    {{-- Category title --}}
    <div class="flex min-h-[3rem] items-center">
        <div class="text-2xl font-semibold transition duration-300">
            Categories
        </div>
    </div>
    {{-- Category list --}}
    <div class="w-full pt-4">
        @foreach ($categories as $category)
            <x-plugins.category
                :name="$category->name"
                :activeClass="$category->activeClass"
            >
                <x-slot name="icon">
                    {!! $category->getIcon() !!}
                </x-slot>
            </x-plugins.category>
        @endforeach
    </div>
</div>
