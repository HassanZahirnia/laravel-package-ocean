<script setup lang="ts">
import type { Package } from '@/types/package'

const $props = defineProps<{
    laravelPackage: Package
}>()

const selectedCategory = useSelectedCategory()

// A function to format large numbers
// Example: 2600 -> 2.6k
// Example: 5100 -> 5.1k
// Example: 11100 -> 11.1k
function formatStars(numStars: number): string {
    if (numStars >= 1000) {
        const formattedNum = (numStars / 1000).toFixed(1)
        return `${formattedNum}k`
    }
    else {
        return `${numStars}`
    }
}

// A function to open the package github link in a new tab
function openGithubLink() {
    window.open($props.laravelPackage.github, '_blank')
}
</script>

<template>
    <div
        class="flex h-60 cursor-pointer flex-col rounded-3xl
        bg-white/50
        p-6
        shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
        ring-1 ring-slate-100 backdrop-blur-xl
        transition
        duration-300 hover:scale-105
        hover:ring-indigo-200 dark:bg-[#362B59]/20
        dark:ring-1
        dark:ring-[#132447]
        dark:hover:ring-indigo-900
        "
        @click="openGithubLink"
        >
        <div class="flex items-center justify-between gap-5">
            <category-pill
                :category="laravelPackage.category"
                @click.stop="selectedCategory = laravelPackage.category"
                />
            <div class="flex items-center gap-2">
                <div class="i-ph-star-duotone text-lg text-[#F5B02B]" />
                <div class="text-sm">
                    {{ formatStars(laravelPackage.stars) }}
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
    </div>
</template>