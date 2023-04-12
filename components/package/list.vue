<script setup lang="ts">
import { orderBy } from 'lodash'
import MiniSearch from 'minisearch'
import { laravelPackages } from '@/database/packages'
import type { PackageSortFields } from '@/types/package'
import { categories, categoriesWithPackagesCount } from '@/database/categories'
import type { selectboxItem } from '@/types/selectbox'
import type { CategoryWithPackagesCount } from '@/types/category'

// Initialize the minisearch instance
const miniSearch = new MiniSearch({
    idField: 'github',
    fields: [
        'name',
        'description',
        'keywords',
        'author',
    ],
    searchOptions: {
        fuzzy: 0.1,
        prefix: true,
    },
})

// Categories for select box
const categoriesForSelectbox = categoriesWithPackagesCount.map((category: CategoryWithPackagesCount): selectboxItem<string> => {
    return {
        name: category.name,
        value: category.name,
        detail: `${category.packagesCount} Packages`,
    }
})

// Index all packages
miniSearch.addAll(laravelPackages)

// Route
const route = useRoute()

// Search
const search = useSearch()

// Selected Category
const selectedCategory = useSelectedCategory()

// Sort field
const sortField = ref<PackageSortFields>('first_release_at')

// Only show official packages
const showOfficialPackages = useShowOfficialPackages()

// Page
const page = ref(Number(route.query.page) || 1)
const pageSize = 9

// Results
const results = ref(laravelPackages)
const resultsPaginated = ref(results.value)

// Update all relevant variables when the route.query changes
watch(
    () => route.query,
    (newQuery, oldQuery) => {
        // Update the search
        if(newQuery.search !== oldQuery?.search)
            search.value = newQuery.search?.toString() || ''

        // Update the page
        if(newQuery.page !== oldQuery?.page)
            page.value = Number(newQuery.page) || 1

        // Update the sort field
        if(newQuery.sort !== oldQuery?.sort)
            sortField.value = newQuery.sort?.toString() as PackageSortFields || 'first_release_at'

        // If the selectedCategory is not included in the categories array, set it to an empty string
        if(newQuery.category !== oldQuery?.category)
            selectedCategory.value = newQuery.category && categories.includes(newQuery.category as typeof categories[number]) ? newQuery.category?.toString() : ''

        // Only use route.query.official if it's value is either '0' or '1', if not set it to '0'
        if(newQuery.official !== oldQuery?.official)
            showOfficialPackages.value = newQuery.official && ['0', '1'].includes(newQuery.official?.toString()) ? newQuery.official?.toString() as '0' | '1' : '0'
    },
    { immediate: true },
)

watch(
    [search, page, sortField, selectedCategory, showOfficialPackages],
    (
        [newSearch, newPage, newSortField, newSelectedCategory, newShowOfficialPackages],
        [oldSearch, oldPage, oldSortField, oldSelectedCategory, oldShowOnlyOfficialPackages],
    ) => {
        results.value = laravelPackages

        // if newPage is changed, scroll to #scroll-to-reference element
        if(newPage !== oldPage) {
            nextTick(() => {
                // If device width is less than 640px (mobile), scroll to #scroll-to-reference element
                if(window.innerWidth < 640)
                    document.querySelector('#scroll-to-reference')?.scrollIntoView({ behavior: 'smooth' })
            })
        }

        // If newSelectedCategory and oldSelectedCategory are not equal, set page to 1
        if(newSelectedCategory !== oldSelectedCategory)
            newPage = 1

        // If newShowOfficialPackages and oldShowOfficialPackages are not equal, set page to 1
        if(newShowOfficialPackages !== oldShowOnlyOfficialPackages)
            newPage = 1

        // Show only official packages if showOfficialPackages is true
        if(newShowOfficialPackages === '1')
            results.value = laravelPackages.filter(laravelPackage => laravelPackage.author === 'laravel')

        // Selected Category
        if(newSelectedCategory)
            results.value = results.value.filter(laravelPackage => laravelPackage.category === newSelectedCategory)

        // Sort packages
        let sortOrder: 'asc' | 'desc' = 'desc'
        switch (newSortField) {
            case 'first_release_at':
                sortOrder = 'desc'
                break
            case 'latest_release_at':
                sortOrder = 'desc'
                break
            case 'stars':
                sortOrder = 'desc'
                break
            default:
                sortOrder = 'desc'
                break
        }
        results.value = orderBy(results.value, newSortField, sortOrder)

        // If search is not empty, search packages using miniSearch,
        // If not return all packages
        if (search.value){
            if(newSearch !== oldSearch)
                newPage = 1

            const searchResult = miniSearch.search(search.value)

            // Filter packages that their `github` property are included in searchResults's `id` property
            // But keep the order from searchResult's score (desc)
            results.value = searchResult.map(searchResultItem => results.value.find(laravelPackage => laravelPackage.github === searchResultItem.id)).filter(Boolean) as typeof laravelPackages
        }
        
        // Paginate results
        const start = (newPage - 1) * pageSize
        const end = start + pageSize
        resultsPaginated.value = results.value.slice(start, end)

        // Update the route
        if(
            results.value.length === laravelPackages.length
            && newPage === 1 && newSearch === ''
            && newSortField === 'first_release_at'
            && newSelectedCategory === ''
            && newShowOfficialPackages === '0'
        ){
            // Clear the query when page number is 1 and the search is empty
            navigateTo({
                path: '/',
                query: {},
            })
        }
        else{
            // Push the new query
            navigateTo({
                path: '/',
                // Only include parameters that are not empty
                query: {
                    ...(newSearch && { search: newSearch }),
                    ...(newPage && { page: newPage }),
                    ...(newSortField && { sort: newSortField }),
                    ...(newSelectedCategory && { category: newSelectedCategory }),
                    ...(newShowOfficialPackages && { official: newShowOfficialPackages }),
                },
            })
        }

        // Update the page number incase it was previously set to 1 because of the search difference
        page.value = newPage
    },
    { immediate: true },
)

// Callback function for the useOffsetPagination's onPageChange option
function updatePageNumber(
    { currentPage, currentPageSize }:
    { currentPage: number; currentPageSize: number },
) {
    // Update the page number,
    // which comes from user interaction with the pagination buttons
    page.value = currentPage
}

// Offset pagination
const {
    currentPage,
    pageCount,
    isFirstPage,
    isLastPage,
    prev,
    next,
} = useOffsetPagination({
    total: computed(() => results.value.length),
    page,
    pageSize,
    onPageChange: updatePageNumber,
})

// Selectbox items for the sort field
const orderItems: selectboxItem<PackageSortFields>[] = [
    {
        name: 'Newest',
        value: 'first_release_at',
        detail: 'Freshly released',
    },
    {
        name: 'Recently Updated',
        value: 'latest_release_at',
        detail: 'Recently updated',
    },
    {
        name: 'Most Stars',
        value: 'stars',
        detail: 'Popular',
    },
]

// Selectbox items for the categories
const categoriesForSelectboxWithAll = [
    { name: 'All Categories', value: '' },
    ...categoriesForSelectbox,
]
</script>

<template>
    <div
        class="w-full
        sticky
        top-5 left-0
        "
        >
        <div class="flex gap-5 flex-wrap items-center justify-between">
            <div
                id="scroll-to-reference"
                class="flex gap-5 scroll-mt-5
                items-center 
                flex-wrap sm:flex-nowrap
                "
                >
                <transition
                    mode="out-in"
                    enter-active-class="duration-150 ease-out"
                    enter-from-class="-translate-x-2 opacity-0"
                    enter-to-class="translate-x-0 opacity-100"
                    leave-active-class="duration-150 ease-in"
                    leave-from-class="translate-x-0 opacity-100"
                    leave-to-class="translate-x-2 opacity-0"
                    >
                    <!-- Title -->
                    <div
                        v-if="!selectedCategory"
                        class="text-2xl font-semibold"
                        >
                        {{ results.length }}
                        Packages
                    </div>
                    <!-- Category selected -->
                    <div
                        v-else
                        class="py-1.5 px-4
                        cursor-pointer truncate rounded-full
                        transition duration-300
                        flex gap-2
                        items-center
                        font-medium
                        bg-slate-300/50
                        hover:bg-slate-300
                        dark:bg-slate-700/50
                        dark:hover:bg-slate-800/50
                        text-slate-600
                        dark:text-slate-400
                        "
                        @click="selectedCategory = ''"
                        >
                        <div class="">
                            {{ selectedCategory }}
                        </div>
                        <div class="i-ph-x-bold" />
                    </div>
                </transition>
            </div>
            <div
                class="xl:flex-1
                flex gap-3
                w-full xl:w-auto
                flex-wrap xl:flex-nowrap
                items-center
                justify-center lg:justify-end
                "
                >
                <!-- Crown/Official package toggle -->
                <div class="flex-1 flex justify-start min-[920px]:justify-end w-40">
                    <div
                        class="relative rounded-xl cursor-pointer group select-none
                        transition-all duration-300 ease-out
                        delay-100
                        overflow-hidden
                        w-40 lg:w-11 h-11
                        flex gap-2 items-center
                        lg:hover:w-40
                        "
                        :class="{
                            'bg-white/50 dark:bg-[#362B59]/30 dark:hover:bg-[#362B59]/40': showOfficialPackages === '0',
                            'lg:w-40 bg-white hover:bg-white/80 dark:bg-indigo-500/20 dark:hover:bg-indigo-500/10': showOfficialPackages === '1',
                        }"
                        @click="showOfficialPackages = showOfficialPackages === '1' ? '0' : '1'"
                        >
                        <div
                            class="i-fluent-emoji-crown text-2xl
                            shrink-0
                            mb-1 ml-2.5
                            "
                            />
                        <div
                            class="text-xs truncate
                            transition duration-300
                            delay-100
                            lg:opacity-0
                            lg:group-hover:opacity-100
                            "
                            :class="{
                                'lg:opacity-100': showOfficialPackages === '1',
                            }"
                            >
                            Official Packages
                        </div>
                    </div>
                </div>
                <!-- Search bar -->
                <ui-search-input />
                <!-- Sort -->
                <ui-selectbox
                    v-model="sortField"
                    class="shrink-0 w-full min-[920px]:w-[12.5rem] relative z-20"
                    :items="orderItems"
                    />
                <!-- Categories -->
                <ui-selectbox
                    v-model="selectedCategory"
                    class="shrink-0 w-full sm:hidden"
                    :items="categoriesForSelectboxWithAll"
                    />
            </div>
        </div>
        <div class="relative min-h-[16rem]">
            <!-- Packages list -->
            <div
                v-auto-animate
                class="pt-6
                grid gap-5
                grid-cols-[repeat(auto-fill,minmax(19rem,1fr))]
                items-start justify-center
                "
                :class="{
                    'min-h-[17rem]': resultsPaginated.length,
                }"
                >
                <package-card
                    v-for="laravelPackage in resultsPaginated"
                    :key="laravelPackage.github"
                    :laravel-package="laravelPackage"
                    />
            </div>
            <!-- Pagination -->
            <div
                v-if="resultsPaginated.length"
                class="px-5 pt-8 flex justify-center"
                >
                <ui-pagination
                    :page-count="pageCount"
                    :current-page="currentPage"
                    :is-first-page="isFirstPage"
                    :is-last-page="isLastPage"
                    @press:next="next"
                    @press:prev="prev"
                    />
            </div>
            <!-- No results message -->
            <transition
                enter-active-class="duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="duration-300 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
                >
                <div
                    v-if="!resultsPaginated.length"
                    class="w-full
                    absolute
                    top-0 right-1/2
                    translate-x-1/2
                    "
                    >
                    <ui-search-result />
                </div>
            </transition>
        </div>
    </div>
</template>