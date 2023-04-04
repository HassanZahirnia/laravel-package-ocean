<script setup lang="ts">
import { orderBy } from 'lodash'
import MiniSearch from 'minisearch'
import { laravelPackages } from '@/database/packages'
import type { PackageSortFields } from '@/types/package'
import { categories, categoriesForSelectbox } from '@/database/categories'
import type { selectboxItem } from '@/types/selectbox'

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

// Index all packages
miniSearch.addAll(laravelPackages)

// Route
const route = useRoute()
const router = useRouter()

// Search
const search = useSearch()

// Selected Category
const selectedCategory = useSelectedCategory()
// If the selectedCategory is not included in the categories array, set it to an empty string
selectedCategory.value = route.query.category && categories.includes(route.query.category as typeof categories[number]) ? route.query.category?.toString() : ''

// Sort field
const sortField = ref<PackageSortFields>('first_release_at')
sortField.value = route.query.sort?.toString() as PackageSortFields ?? 'first_release_at'

// Only show official packages
const showOfficialPackages = useShowOfficialPackages()
// Only use route.query.official if it's value is either '0' or '1', if not set it to '0'
showOfficialPackages.value = route.query.official && ['0', '1'].includes(route.query.official?.toString()) ? route.query.official?.toString() as '0' | '1' : '0'

// Page
const page = ref(Number(route.query.page) || 1)
const pageSize = 9

// Results
const results = ref(laravelPackages)
const resultsPaginated = ref(results.value)

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
        ){
            // Clear the query when page number is 1 and the search is empty
            router.push({
                path: '/',
                query: {},
            })
        }
        else{
            // Push the new query
            router.push({
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

function updatePageNumber(
    { currentPage, currentPageSize }:
    { currentPage: number; currentPageSize: number },
) {
    // Update the page number,
    // which comes from user interaction with the pagination buttons
    page.value = currentPage
}

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

const orderItems: selectboxItem<PackageSortFields>[] = [
    { name: 'Newest', value: 'first_release_at' },
    { name: 'Recently Updated', value: 'latest_release_at' },
    { name: 'Most Stars', value: 'stars' },
]

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
                <div class="text-2xl font-semibold">
                    Packages
                </div>
                <transition
                    enter-active-class="duration-150 ease-out"
                    enter-from-class="translate-x-2 opacity-0"
                    enter-to-class="translate-x-0 opacity-100"
                    leave-active-class="duration-150 ease-in"
                    leave-from-class="translate-x-0 opacity-100"
                    leave-to-class="translate-x-2 opacity-0"
                    >
                    <div
                        v-if="selectedCategory"
                        class="py-1 px-3
                        cursor-pointer truncate rounded-full
                        transition duration-300
                        flex gap-2
                        items-center
                        text-sm
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
                <!-- Official package toggle -->
                <div class="flex-1 flex justify-start min-[920px]:justify-end w-40">
                    <div
                        class="relative rounded-xl cursor-pointer group select-none
                        transition-all duration-300
                        overflow-hidden
                        w-40 lg:w-11 h-11
                        flex gap-2 items-center
                        lg:hover:w-40
                        "
                        :class="{
                            'bg-white/50 dark:bg-[#362B59]/20 dark:hover:bg-[#362B59]/30': showOfficialPackages === '0',
                            'lg:w-40 bg-white dark:bg-indigo-500/20 dark:hover:bg-indigo-500/10': showOfficialPackages === '1',
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
                    class="shrink-0 w-full min-[920px]:w-52 relative z-20"
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