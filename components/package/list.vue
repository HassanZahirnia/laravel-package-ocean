<script setup lang="ts">
import lodash from 'lodash'
import MiniSearch from 'minisearch'
import { useStorage } from '@vueuse/core'
import dayjs from 'dayjs'
import { laravelPackages } from '@/database/packages'
import type { Package, PackageSortFields } from '@/types/package'
import { categories, categoriesWithPackagesCount } from '@/database/categories'
import type { selectboxItem } from '@/types/selectbox'
import type { CategoryWithPackagesCount } from '@/types/category'

const { isEmpty, orderBy } = lodash

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

// Router
const router = useRouter()

// Search
const search = useSearch()

// Selected Category
const selectedCategory = useSelectedCategory()

// Default sort field
const DEFAULT_SORT_FIELD = 'first_release_at'

// Sort field
const sortField = ref<PackageSortFields>(DEFAULT_SORT_FIELD)

// Last visit date
const lastVisitDate = useStorage<string | null>('lastVisitDate', null)

// New visit date
const newVisitDate = useStorage<string | null>('newVisitDate', null)

const GRACE_PERIOD = 5

// If the lastVisitDate is empty, set the current time
if (!lastVisitDate.value){
    lastVisitDate.value = new Date().toISOString()
    newVisitDate.value = null
}
else {
    // If newVisitDate is empty, set it to the current time
    // so that on the next visit, we have something to compare the GRACE_PERIOD minutes difference with
    if (!newVisitDate.value){
        newVisitDate.value = new Date().toISOString()
    }
    else {
        // If the difference between the lastVisitDate and newVisitDate is more than GRACE_PERIOD minutes,
        // set the lastVisitDate to the current time and newVisitDate to null
        if (dayjs().diff(newVisitDate.value, 'minutes') > GRACE_PERIOD){
            lastVisitDate.value = new Date().toISOString()
            newVisitDate.value = null
        }
    }
}

// New packages since last visit
const newPackagesSinceLastVisit = computed(() => laravelPackages.filter(laravelPackage => dayjs(laravelPackage.created_at).isAfter(lastVisitDate.value)))

// Show new packages since last visit
const showNewPackagesSinceLastVisit = ref(false)

// Only show official packages
const showOfficialPackages = useShowOfficialPackages()

// Page
const page = ref(Number(route.query.page) || 1)
const pageSize = 9

// Results
const results = ref(laravelPackages)
const resultsPaginated = ref(results.value)

watch(
    () => route.query,
    (newQuery, oldQuery) => {
        // Update the search
        if (newQuery.search !== oldQuery?.search)
            search.value = newQuery.search?.toString() || ''

        // Update the page
        if (newQuery.page !== oldQuery?.page)
            page.value = Number(newQuery.page) || 1

        // Update the sort field
        if (newQuery.sort !== oldQuery?.sort)
            sortField.value = newQuery.sort?.toString() as PackageSortFields || 'first_release_at'

        // If the selectedCategory is not included in the categories array, set it to an empty string
        if (newQuery.category !== oldQuery?.category)
            selectedCategory.value = newQuery.category && categories.includes(newQuery.category as typeof categories[number]) ? newQuery.category?.toString() : ''

        // Only use route.query.official if it's value is either '0' or '1', if not set it to '0'
        if (newQuery.official !== oldQuery?.official)
            showOfficialPackages.value = newQuery.official && ['0', '1'].includes(newQuery.official?.toString()) ? newQuery.official?.toString() as '0' | '1' : '0'
    },
    { immediate: true },
)

watch(
    [search, page, sortField, selectedCategory, showOfficialPackages, showNewPackagesSinceLastVisit],
    (
        [newSearch, newPage, newSortField, newSelectedCategory, newShowOfficialPackages, newShowNewPackagesSinceLastVisit],
        [oldSearch, oldPage, oldSortField, oldSelectedCategory, oldShowOnlyOfficialPackages, oldShowNewPackagesSinceLastVisit],
    ) => {
        results.value = laravelPackages

        if (newShowNewPackagesSinceLastVisit)
            results.value = newPackagesSinceLastVisit.value

        // if newPage is changed, scroll to #scroll-to-reference element
        if (newPage !== oldPage) {
            nextTick(() => {
                // If device width is less than 640px (mobile), scroll to #scroll-to-reference element
                if (process.client && window.innerWidth < 640)
                    document.querySelector('#scroll-to-reference')?.scrollIntoView({ behavior: 'smooth' })
            })
        }

        // If newSelectedCategory and oldSelectedCategory are not equal, set page to 1
        if (
            (newSelectedCategory !== oldSelectedCategory)
            && !(isEmpty(newSelectedCategory) && isEmpty(oldSelectedCategory))
            && oldPage === newPage
        )
            newPage = 1



        // If newShowOfficialPackages and oldShowOfficialPackages are not equal, set page to 1
        if (
            (newShowOfficialPackages !== oldShowOnlyOfficialPackages)
            && !(isEmpty(newShowOfficialPackages) && isEmpty(oldShowOnlyOfficialPackages))
            && oldPage === newPage
        )
            newPage = 1

        // Show only official packages if showOfficialPackages is true
        if (newShowOfficialPackages === '1')
            results.value = laravelPackages.filter(laravelPackage => laravelPackage.author === 'laravel')

        // Selected Category
        if (newSelectedCategory)
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
            case 'created_at':
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
            if (newSearch !== oldSearch)
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
        if (
            results.value.length === laravelPackages.length
            && newPage === 1
            && newSortField === DEFAULT_SORT_FIELD
            && isEmpty(newSearch)
            && isEmpty(newSelectedCategory)
            && isEmpty(newShowOfficialPackages)
        ){
            // Clear the query when page number is 1 and the search is empty
            router.replace({
                path: '/',
                query: {},
            })
        }
        else {
            // Push the new query
            router.replace({
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

// Total results length
const totalResultsLength = computed(() => results.value.length)

// Offset pagination
const {
    currentPage,
    pageCount,
    isFirstPage,
    isLastPage,
    prev,
    next,
} = useOffsetPagination({
    total: totalResultsLength,
    page,
    pageSize,
    onPageChange: updatePageNumber,
})

// Selectbox items for the sort field
const orderItems: selectboxItem<PackageSortFields>[] = [
    {
        name: 'Newest',
        value: 'first_release_at',
        detail: 'Freshly Released',
    },
    {
        name: 'Most Stars',
        value: 'stars',
        detail: 'Popular',
    },
    {
        name: 'Recently Added',
        value: 'created_at',
        detail: 'Latest Additions',
    },
    {
        name: 'Latest Release',
        value: 'latest_release_at',
        detail: 'Recent Versions',
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
                class="flex gap-4 scroll-mt-5
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
                <!-- New Since Last Visit Button -->
                <ui-tooltip
                    v-if="newPackagesSinceLastVisit.length"
                    :content="newPackagesSinceLastVisit.length + ' New packages were added since your last visit !'"
                    theme="emerald"
                    @click.stop.prevent="showNewPackagesSinceLastVisit = !showNewPackagesSinceLastVisit"
                    >
                    <div

                        class="py-1.5 px-4 select-none
                        rounded-full cursor-pointer
                        transition-all duration-300
                        flex gap-2 items-center
                        font-medium
                        hover:brightness-105
                        "
                        :class="{
                            'bg-slate-300/50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-400': !showNewPackagesSinceLastVisit,
                            'bg-teal-200/70 text-teal-600 dark:text-teal-500 dark:bg-teal-500/20': showNewPackagesSinceLastVisit,
                        }"
                        >
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400"
                                :class="{
                                    'opacity-75': !showNewPackagesSinceLastVisit,
                                    'opacity-0': showNewPackagesSinceLastVisit,
                                }"
                                />
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-teal-500" />
                        </span>
                        <div class="">
                            {{ newPackagesSinceLastVisit.length }}
                            <span class="inline">New Item</span>
                            <span class="inline">{{ newPackagesSinceLastVisit.length > 1 ? 's' : '' }}</span>
                        </div>
                    </div>
                </ui-tooltip>
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
                        w-[12.5rem] sm:w-40 lg:w-11 h-11
                        flex gap-2 items-center
                        lg:hover:w-40
                        "
                        :class="{
                            'bg-white/50 dark:bg-[#362B59]/30 dark:hover:bg-[#362B59]/40': showOfficialPackages !== '1',
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
                            class="truncate
                            leading-5
                            sm:text-xs
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
                    :total-results-length="totalResultsLength"
                    :page-count="pageCount"
                    :current-page="currentPage"
                    :is-first-page="isFirstPage"
                    :is-last-page="isLastPage"
                    @press:next="next"
                    @press:prev="prev"
                    @press:first="currentPage = 1"
                    @press:last="currentPage = pageCount"
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