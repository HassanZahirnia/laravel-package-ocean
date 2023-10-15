<script setup lang="ts">
defineProps<{
    currentPage: number
    pageCount: number
    isFirstPage: boolean
    isLastPage: boolean
    totalResultsLength: number
}>()

const $emit = defineEmits<{
    (e: 'press:next'): void
    (e: 'press:prev'): void
    (e: 'press:last'): void
    (e: 'press:first'): void
}>()
</script>

<template>
    <div class="flex gap-3 items-center">
        <div
            class="rounded-full
            h-10 w-10
            backdrop-blur-xl
            transition duration-300
            grid place-items-center
            bg-white/80
            dark:bg-[#110E26]/50
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            "
            :class="{
                'cursor-not-allowed opacity-20': isFirstPage,
                'cursor-pointer hover:bg-white dark:hover:bg-[#15112e]': !isFirstPage,
            }"
            @click="$emit('press:first')"
            >
            <div class="i-solar:double-alt-arrow-left-bold-duotone text-2xl" />
        </div>
        <div
            class="rounded-full
            h-10 w-10
            backdrop-blur-xl
            transition duration-300
            grid place-items-center
            bg-white/80
            dark:bg-[#110E26]/50
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            "
            :class="{
                'cursor-not-allowed opacity-20': isFirstPage,
                'cursor-pointer hover:bg-white dark:hover:bg-[#15112e]': !isFirstPage,
            }"
            @click="$emit('press:prev')"
            >
            <div class="i-solar:alt-arrow-left-line-duotone text-2xl" />
        </div>
        <div class="w-16 grid place-items-center">
            <div class="h-12 w-14 relative">
                <div
                    v-for="i in totalResultsLength"
                    :key="i"
                    class="
                    absolute
                    text-xl
                    transition-all duration-300
                    font-semibold
                    "
                    :class="{
                        'top-0 right-[60%]': i === currentPage,
                        '-top-5 right-[20%] opacity-0': i > currentPage,
                        'top-5 right-[90%] opacity-0': i < currentPage,
                    }"
                    >
                    {{ i }}
                </div>
                <div
                    class="rounded-full
                    h-[0.5px] w-10
                    absolute
                    top-1/2 right-1/2
                    -translate-y-1/2 translate-x-1/2
                    -rotate-45
                    bg-current
                    "
                    />
                <div
                    class="absolute bottom-1 left-[60%]
                    text-sm
                    "
                    >
                    {{ pageCount }}
                </div>
            </div>
        </div>
        <div
            class="rounded-full
            h-10 w-10
            backdrop-blur-xl
            transition duration-300
            grid place-items-center
            bg-white/80
            dark:bg-[#110E26]/50
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            "
            :class="{
                'cursor-not-allowed opacity-20': isLastPage,
                'cursor-pointer hover:bg-white dark:hover:bg-[#15112e]': !isLastPage,
            }"
            @click="$emit('press:next')"
            >
            <div class="i-solar:alt-arrow-right-line-duotone text-2xl" />
        </div>
        <div
            class="rounded-full
            h-10 w-10
            backdrop-blur-xl
            transition duration-300
            grid place-items-center
            bg-white/80
            dark:bg-[#110E26]/50
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            "
            :class="{
                'cursor-not-allowed opacity-20': isLastPage,
                'cursor-pointer hover:bg-white dark:hover:bg-[#15112e]': !isLastPage,
            }"
            @click="$emit('press:last')"
            >
            <div class="i-solar:double-alt-arrow-right-bold-duotone text-2xl" />
        </div>
    </div>
</template>