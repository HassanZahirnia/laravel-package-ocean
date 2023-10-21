<div class="sticky left-0 top-5 w-full">
    <div class="flex flex-wrap items-center justify-between gap-5">
        <div
            id="scroll-to-reference"
            class="flex scroll-mt-5 flex-wrap items-center gap-4 sm:flex-nowrap"
        >
            <div class="grid min-h-[3rem] place-items-center">
                {{-- Title --}}
                <div
                    x-show="!selectedCategory"
                    x-transition:enter="transition duration-150 ease-out"
                    x-transition:enter-start="-translate-x-2 opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="translate-x-0 opacity-100"
                    x-transition:leave-end="-translate-x-2 opacity-0"
                    class="text-2xl font-semibold [grid-area:1/-1]"
                >
                    0 Packages
                </div>
                {{-- Category selected --}}
                <div
                    x-on:click="selectedCategory = ''"
                    x-show="selectedCategory"
                    x-transition:enter="transition delay-[50ms] duration-150 ease-out"
                    x-transition:enter-start="translate-x-2 opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="translate-x-0 opacity-100"
                    x-transition:leave-end="translate-x-2 opacity-0"
                    class="flex h-9 cursor-pointer items-center gap-2 truncate rounded-full bg-slate-300/50 px-4 font-medium text-slate-600 transition duration-300 [grid-area:1/-1] hover:bg-slate-300 dark:bg-slate-700/50 dark:text-slate-400 dark:hover:bg-slate-800/50"
                >
                    <div
                        x-text="selectedCategory"
                        class="min-w-[5rem]"
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
            {{--
                <ui-new-packages-button
                v-if="newPackagesSinceLastVisit.length"
                :new-packages-count="newPackagesSinceLastVisit.length"
                :is-active="showNewPackagesSinceLastVisit"
                @toggle="showNewPackagesSinceLastVisit = !showNewPackagesSinceLastVisit"
                />
            --}}
        </div>
        <div
            class="flex w-full flex-wrap items-center justify-center gap-3 lg:justify-end xl:w-auto xl:flex-1 xl:flex-nowrap"
        >
            {{-- Crown/Official package toggle --}}
            {{--
                <ui-official-package-toggle
                :is-active="showOfficialPackages"
                @toggle="showOfficialPackages = showOfficialPackages === '1' ? '0' : '1'"
                />
            --}}

            {{-- Search bar --}}
            <x-packages.search-input />

            {{-- Sort --}}
            {{--
                <ui-selectbox
                v-model="sortField"
                class="relative z-20 w-full shrink-0 min-[920px]:w-[12.5rem]"
                :items="orderItems"
                />
            --}}

            {{-- Categories --}}
            {{--
                <ui-selectbox
                v-model="selectedCategory"
                class="w-full shrink-0 sm:hidden"
                :items="categoriesForSelectboxWithAll"
                />
            --}}
        </div>
    </div>
</div>