<script setup lang="ts">
import type { LaravelPackage } from '@/types/laravel-package'

const $props = defineProps<{
    laravelPackage: LaravelPackage
}>()

function formatLargeNumbers(n: number): string {
    const value = n.toFixed().toString()
    if (value.length >= 4 && value.length <= 6) 
        return `${value.slice(0, -3)}K`
	
    if (value.length >= 7 && value.length <= 9) 
        return `${value.slice(0, -6)}M`
	
    if (value.length >= 10 && value.length <= 12) 
        return `${value.slice(0, -9)}B`
	
    return value
}
</script>

<template>
    <a
        :href="laravelPackage.github"
        class="flex h-60 flex-col rounded-3xl
        bg-white/20
        p-7
        shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
        ring-1 ring-slate-100 backdrop-blur-xl
        transition
        duration-300 hover:scale-105
        dark:bg-[#362B59]/20 dark:ring-1
        dark:ring-[#132447]
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
        <div class="flex-1 pt-5">
            <div
                class="text-lg font-semibold
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