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

const route = useRoute()
const search = useSearch()
const page = usePage()
const pageSize = usePageSize()

page.value = route.query.page ? Number(route.query.page) : 1

const results = computed(() => {
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
        return laravelPackages.filter(laravelPackage => searchResult.map(result => result.id).includes(laravelPackage.composer))
    }

    return laravelPackages
})

const resultsPaginated = computed(() => {
    const start = (page.value - 1) * pageSize.value
    const end = start + pageSize.value

    return results.value.slice(start, end)
})
</script>

<template>
    <div class="w-full">
        <div class="flex flex-wrap items-center justify-between gap-5">
            <div class="text-2xl font-semibold">
                Packages
            </div>
            <ui-search-input />
        </div>
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
        <div class="flex justify-center px-5 pt-8">
            <ui-pagination :total="results.length" />
        </div>
    </div>
</template>