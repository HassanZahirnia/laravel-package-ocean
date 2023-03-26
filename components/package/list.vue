<script setup lang="ts">
import MiniSearch from 'minisearch'
import { laravelPackages } from '@/database/packages'

// Initialize the minisearch instance
const miniSearch = new MiniSearch({
    idField: 'composer',
    fields: ['name', 'description'],
})

// Index all packages
miniSearch.addAll(laravelPackages)

// Route
const route = useRoute()
const router = useRouter()

// Search
const search = useSearch()

// Page
const page = ref(route.query.page ? Number(route.query.page) : 1)
const pageSize = ref(2)

// Results
const results = ref(laravelPackages)
const resultsPaginated = ref(results.value)

watch(
    [search, page],
    ([newSearch, newPage], [oldSearch, oldPage]) => {
        // If search is not empty, search packages using miniSearch,
        // If not return all packages
        if (search.value){
            const searchResult = miniSearch.search(search.value,
                {
                    fuzzy: 0.1,
                    prefix: true,
                },
            )
            
            // Return only packages that their `composer` property are included in searchResults's `id` property
            results.value = laravelPackages.filter(laravelPackage => searchResult.map(result => result.id).includes(laravelPackage.composer))
        }
        else{
            // Return all packages
            results.value = laravelPackages
        }

        if(newSearch !== oldSearch)
            newPage = 1

        // Paginate results
        const start = (newPage - 1) * pageSize.value
        const end = start + pageSize.value
        resultsPaginated.value = results.value.slice(start, end)

        // Update the route
        router.push({
            path: '/',
            query: { page: newPage, search: newSearch },
        })
    },
    { immediate: true },
)

function updatePageNumber({ currentPage, currentPageSize }: { currentPage: number; currentPageSize: number }) {
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
    page: page.value,
    pageSize: pageSize.value,
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
        <!-- Packages list -->
        <div
            v-auto-animate
            class="grid grid-cols-[repeat(auto-fill,19rem)] items-start gap-5 pt-6"
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
    </div>
</template>