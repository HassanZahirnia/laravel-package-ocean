<script setup lang="ts">
import MiniSearch from 'minisearch'
import { laravelPackages } from '@/database/packages'

// Initialize the minisearch instance
const miniSearch = new MiniSearch({
    idField: 'composer',
    fields: [
        'name',
        'description',
        'keywords',
    ],
})

// Index all packages
miniSearch.addAll(laravelPackages)

// Route
const route = useRoute()
const router = useRouter()

// Search
const search = useSearch()

// Page
const page = ref(Number(route.query.page) || 1)
const pageSize = 9

// Results
const results = ref(laravelPackages)
const resultsPaginated = ref(results.value)

watch(
    [search, page],
    ([newSearch, newPage], [oldSearch, oldPage]) => {
        // If search is not empty, search packages using miniSearch,
        // If not return all packages
        if (search.value){
            if(newSearch !== oldSearch)
                newPage = 1

            const searchResult = miniSearch.search(search.value,
                {
                    fuzzy: 0.1,
                    prefix: true,
                },
            )

            // Return only packages that their `composer` property are included in searchResults's `id` property
            results.value = laravelPackages.filter(
                laravelPackage => searchResult.map(result => result.id).includes(laravelPackage.composer),
            )
        }
        else{
            // Return all packages
            results.value = laravelPackages
        }

        // Paginate results
        const start = (newPage - 1) * pageSize
        const end = start + pageSize
        resultsPaginated.value = results.value.slice(start, end)

        // Update the route
        if(results.value.length === laravelPackages.length && newPage === 1 && newSearch === ''){
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
                query: { page: newPage, search: newSearch },
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
</script>

<template>
    <div class="w-full">
        <div class="flex flex-wrap items-center justify-between gap-5">
            <div class="text-2xl font-semibold">
                Packages
            </div>
            <!-- Search bar -->
            <ui-search-input />
        </div>
        <div class="relative min-h-[16rem]">
            <!-- Packages list -->
            <div
                v-auto-animate
                class="grid grid-cols-[repeat(auto-fill,19rem)] items-start gap-5 pt-6"
                :class="{
                    'min-h-[17rem]': resultsPaginated.length,
                }"
                >
                <package-card
                    v-for="laravelPackage in resultsPaginated"
                    :key="laravelPackage.composer"
                    :laravel-package="laravelPackage"
                    />
            </div>
            <!-- Pagination -->
            <div
                v-if="resultsPaginated.length"
                class="flex justify-center px-5 pt-8"
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
                    class="absolute top-0 right-1/2 translate-x-1/2"
                    >
                    <ui-search-result />
                </div>
            </transition>
        </div>
    </div>
</template>