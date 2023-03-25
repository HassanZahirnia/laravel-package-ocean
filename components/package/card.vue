<script setup lang="ts">
import type { LaravelPackage } from '@/types/laravel-package'

const $props = defineProps<{
    laravelPackage: LaravelPackage
}>()

// A function to format large numbers
// Example: 1200 -> 1.1k
// Example: 12000 -> 12k
function formatLargeNumbers(number: number) {
    if (number < 1000) 
        return number
    

    const numberString = number.toString()
    const firstDigit = numberString[0]
    const lastTwoDigits = numberString.slice(1, 3)
    const lastDigit = numberString.slice(-1)

    if (lastTwoDigits === '00') 
        return `${firstDigit}k`
    

    if (lastDigit === '0') 
        return `${firstDigit}.${lastTwoDigits[0]}k`
    

    return `${firstDigit}.${lastTwoDigits}k`
}
</script>

<template>
    <a
        :href="laravelPackage.github"
        class="flex h-60 flex-col rounded-3xl
        bg-white/50
        p-6
        shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
        ring-1 ring-slate-100 backdrop-blur-xl
        transition
        duration-300 hover:scale-105
        hover:ring-indigo-300 dark:bg-[#362B59]/20
        dark:ring-1
        dark:ring-[#132447]
        dark:hover:ring-indigo-900
        "
        >
        <div class="flex items-center justify-between gap-5">
            <category-pill
                :category="laravelPackage.category"
                />
            <div class="flex items-center gap-2">
                <div class="i-ph-star-duotone text-lg text-[#F5B02B]" />
                <div class="text-sm">
                    {{ formatLargeNumbers(laravelPackage.stars) }}
                </div>
            </div>
        </div>
        <div class="flex-1 pt-6">
            <div
                class="font-semibold
                text-[#545D82]
                dark:text-[#DEE4F1]
                "
                >
                {{ laravelPackage.name }}
            </div>
            <div
                class="pt-1.5 text-sm
                text-[#959BAF]
                dark:text-[#828CAC]
                "
                >
                {{ laravelPackage.description }}
            </div>
        </div>
        <div
            class="flex items-center gap-2 pt-7
            text-[#505878]
            dark:text-[#BECDF2]
            "
            >
            <div class="i-ph-github-logo-duotone text-xl" />
            <div
                class="text-sm font-medium"
                >
                {{ laravelPackage.repo }}
            </div>
        </div>
    </a>
</template>