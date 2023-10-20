<div class="hidden w-full max-w-[15rem] sm:block sm:pb-20">
    {{-- Category title --}}
    <div class="flex min-h-[3rem] items-center">
        <div class="text-2xl font-semibold transition duration-300">
            Categories
        </div>
    </div>
    {{-- Category list --}}
    <div class="w-full pt-4">
        <template
            x-data="{
                // Sort categories by order
                sortedCategories: categories.sort((a, b) => a.order - b.order),
            }"
            x-for="category in sortedCategories"
            :key="category.name"
        >
            <x-packages.category></x-packages.category>
        </template>
    </div>
</div>
