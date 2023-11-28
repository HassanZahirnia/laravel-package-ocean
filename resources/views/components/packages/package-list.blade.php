<div class="sticky left-0 top-5 w-full">
    <div class="flex flex-wrap items-center justify-between gap-5">
        <div
            id="scroll-to-reference"
            class="flex scroll-mt-5 flex-wrap items-center gap-4 sm:flex-nowrap"
        >
            <div
                x-data="{
                    titleAnimationEnd: $wire.selectedCategory === '' ? false : true,
                    categoryAnimationEnd: $wire.selectedCategory === '' ? true : false,
                }"
                class="grid min-h-[3rem] items-center"
            >
                {{-- Title --}}
                <div
                    x-show="!$wire.selectedCategory && categoryAnimationEnd"
                    x-transition:enter="transition duration-150 ease-out"
                    x-transition:enter-start="-translate-x-2 opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    x-transition:leave="transition duration-150 ease-out"
                    x-transition:leave-start="translate-x-0 opacity-100"
                    x-transition:leave-end="-translate-x-2 opacity-0"
                    x-on:transitionend="titleAnimationEnd = true"
                    class="text-2xl font-semibold [grid-area:1/-1]"
                >
                    {{ $this->packages->total() }}
                    Packages
                </div>
                {{-- Category selected --}}
                <div
                    wire:click="selectCategory('')"
                    x-show="$wire.selectedCategory && titleAnimationEnd"
                    x-transition:enter="transition delay-[50ms] duration-150 ease-out"
                    x-transition:enter-start="translate-x-2 opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    x-transition:leave="transition duration-150 ease-out"
                    x-transition:leave-start="translate-x-0 opacity-100"
                    x-transition:leave-end="translate-x-2 opacity-0"
                    x-on:transitionend="categoryAnimationEnd = true"
                    class="flex h-9 cursor-pointer select-none items-center gap-2 truncate rounded-full bg-slate-300/50 px-4 font-medium text-slate-600 transition duration-300 [grid-area:1/-1] hover:bg-slate-300 dark:bg-slate-700/50 dark:text-slate-400 dark:hover:bg-slate-800/50"
                >
                    <div
                        x-data="{
                            selectedCategoryCopy: $wire.selectedCategory,

                            // When selectedCategory changes, update selectedCategoryCopy, unless it's empty
                            init() {
                                $watch('$wire.selectedCategory', (value) => {
                                    if (value) $data.selectedCategoryCopy = value
                                })
                            },
                        }"
                        x-text="selectedCategoryCopy"
                    ></div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 256 256"
                    >
                        <path
                            fill="currentColor"
                            d="M208.49 191.51a12 12 0 0 1-17 17L128 145l-63.51 63.49a12 12 0 0 1-17-17L111 128L47.51 64.49a12 12 0 0 1 17-17L128 111l63.51-63.52a12 12 0 0 1 17 17L145 128Z"
                        />
                    </svg>
                </div>
            </div>

            {{-- New Since Last Visit Button --}}
            <x-packages.new-packages-badge />
        </div>
        <div
            class="flex w-full flex-wrap items-center justify-center gap-3 lg:justify-end xl:w-auto xl:flex-1 xl:flex-nowrap"
        >
            {{-- Crown/Official package toggle --}}
            <x-packages.official-package-toggle />

            {{-- Search bar --}}
            <x-packages.search-input />

            {{-- Sort --}}
            <div class="w-full shrink-0 min-[920px]:w-[12.5rem]">
                <div class="relative z-20">
                    <select
                        wire:model.live="sortSelectValue"
                        class="relative w-full cursor-pointer appearance-none rounded-xl border-none bg-white/50 py-3 pl-3.5 pr-10 text-left leading-5 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] transition duration-300 placeholder:text-[#9095AE] hover:bg-white/80 dark:bg-[#362B59]/20 dark:hover:bg-[#362B59]/40 sm:text-sm"
                    >
                        @foreach ($this->sortSelectItems() as $item)
                            <option
                                value="{{ $item['value'] }}"
                                class="group relative cursor-pointer select-none bg-indigo-100 py-2.5 pl-9 pr-4 text-indigo-900 transition duration-200 first:pt-3 last:pb-3 dark:bg-indigo-900 dark:text-indigo-100"
                            >
                                {{ $item['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Categories --}}
            <div class="w-full shrink-0 sm:hidden">
                <div class="relative z-20">
                    <select
                        wire:model.live="selectedCategory"
                        class="relative w-full cursor-pointer appearance-none rounded-xl border-none bg-white/50 py-3 pl-3.5 pr-10 text-left leading-5 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] transition duration-300 placeholder:text-[#9095AE] hover:bg-white/80 dark:bg-[#362B59]/20 dark:hover:bg-[#362B59]/40 sm:text-sm"
                    >
                        @foreach ($this->categoriesSelectItems() as $item)
                            <option
                                value="{{ $item['value'] }}"
                                class="group relative cursor-pointer select-none bg-indigo-100 py-2.5 pl-9 pr-4 text-indigo-900 transition duration-200 first:pt-3 last:pb-3 dark:bg-indigo-900 dark:text-indigo-100"
                            >
                                {{ $item['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="relative min-h-[16rem]">
        {{-- Packages list --}}
        <div
            x-init="autoAnimate($el)"
            class="relative grid grid-cols-[repeat(auto-fill,minmax(19rem,1fr))] items-start justify-center gap-5 pt-6"
            :class="{
                'min-h-[17rem]': $wire.packages.length,
            }"
        >
            @foreach ($this->packages as $package)
                <x-packages.package-card :$package />
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($this->packages->total() !== 0)
            <div class="flex justify-center px-5 pt-8">
                <x-pagination />
            </div>
        @endif

        {{-- No results message --}}
        @if ($this->packages->total() === 0)
            <div class="absolute right-1/2 top-0 w-full translate-x-1/2">
                <x-search-result />
            </div>
        @endif
    </div>
</div>
