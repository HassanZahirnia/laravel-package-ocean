<script setup lang="ts">
const route = useRoute()
const router = useRouter()
const page = usePage()
const search = useSearch()

const $props = defineProps<{
    total: number
}>()

const pageSize = usePageSize()

page.value = route.query.page ? Number(route.query.page) : 1

watch(page, (newValue) => {
    router.push({
        path: '/',
        query: { page: newValue, search: search.value },
    })
})

function fetchData({ currentPage, currentPageSize }: { currentPage: number; currentPageSize: number }) {
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
    total: $props.total,
    page: page.value,
    pageSize: pageSize.value,
    onPageChange: fetchData,
})
</script>

<template>
    <div class="flex items-center gap-4">
        <div
            class="grid h-10 w-10 cursor-pointer
            place-items-center rounded-full
            bg-white/50
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            backdrop-blur-xl
            transition duration-300
            hover:bg-white
            dark:bg-[#110E26]/50
            dark:hover:bg-[#110E26]
            "
            @click="prev"
            >
            <div class="i-ph-caret-left-thin text-2xl" />
        </div>
        <div class="grid w-16 place-items-center">
            <div class="relative h-12 w-14">
                <div class="absolute top-0 right-[60%] text-xl font-semibold">
                    {{ currentPage }}
                </div>
                <div
                    class="absolute top-1/2 right-1/2
                    h-[0.5px] w-10 -translate-y-1/2
                    translate-x-1/2 -rotate-45
                    rounded-full bg-current
                    "
                    />
                <div class="absolute bottom-1 left-[60%] text-sm">
                    {{ pageCount }}
                </div>
            </div>
        </div>
        <div
            class="grid h-10 w-10 cursor-pointer
            place-items-center rounded-full
            bg-white/50
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            backdrop-blur-xl
            transition duration-300
            hover:bg-white
            dark:bg-[#110E26]/50
            dark:hover:bg-[#110E26]
            "
            @click="next"
            >
            <div class="i-ph-caret-right-thin text-2xl" />
        </div>
    </div>
</template>