<script setup lang="ts">
import { gsap } from 'gsap'
import type { Package } from '@/types/package'

const $props = defineProps<{
    laravelPackage: Package
}>()

const selectedCategory = useSelectedCategory()

// A function to format large numbers
// Example: 2600 -> 2.6k
function formatStars(numStars: number): string {
    if (numStars >= 1000) {
        const formattedNum = (numStars / 1000).toFixed(1)
        return `${formattedNum}k`
    }
    else {
        return `${numStars}`
    }
}

// Get author and name of repo from the github link
const repoName = computed(() => {
    const githubLink = $props.laravelPackage.github
    const githubLinkParts = githubLink.split('/')
    const author = githubLinkParts[githubLinkParts.length - 2]
    const repo = githubLinkParts[githubLinkParts.length - 1]
    return `${author}/${repo}`
})

const repoNameTooltipCondition = computed(() => repoName.value.length > 34 || window.innerWidth < 370)

// Check whether detected_compatible_versions includes 9 or 10, or one of it's elements includes a plus sign like '5+'
const isCompatibleWithLatestLaravelVersion = computed(() => {
    const detectedCompatibleVersions = $props.laravelPackage.detected_compatible_versions
    return detectedCompatibleVersions.includes('9')
        || detectedCompatibleVersions.includes('10')
        || detectedCompatibleVersions.some(version => version.toString().includes('+'))
})

const compatiblityMessage = computed(() => {
    if (isCompatibleWithLatestLaravelVersion.value)
        return 'Compatible with maintained versions of Laravel'
    else
        return 'Not compatible with maintained versions of Laravel'
})

const cardIsHovering = ref(false)
const warningIcon = ref<HTMLElement | null>(null)
let warningIconTimeline: gsap.core.Timeline | null = null

onMounted(() => {
    if(isCompatibleWithLatestLaravelVersion.value || $props.laravelPackage.detected_compatible_versions.length === 0) 
        return
    
    warningIconTimeline = gsap.timeline({
        paused: true,
    })
        .to(warningIcon.value, {
            keyframes: [
                { rotate: 0, scale: 1 },
                { rotate: -30, scale: 1 },
                { rotate: 30, scale: 1.5 },
                { rotate: -20, scale: 1.5 },
                { rotate: 20, scale: 1.3 },
                { rotate: -10, scale: 1.2 },
                { rotate: 10, scale: 1.1 },
                { rotate: 0, scale: 1 },
            ],
            ease: 'power4.out',
            duration: 3,
        })

})

watch(
    cardIsHovering,
    (value) => {
        if(isCompatibleWithLatestLaravelVersion.value || $props.laravelPackage.detected_compatible_versions.length === 0) 
            return
            
        if (value) 
            warningIconTimeline?.play(0)
        else
            warningIconTimeline?.pause(0)
        
    })
</script>

<template>
    <a
        :href="laravelPackage.github"
        target="_blank"
        class="rounded-3xl cursor-pointer
        h-64
        p-6
        backdrop-blur-xl
        transition duration-300
        flex flex-col
        bg-white/50
        dark:bg-[#362B59]/20
        ring-1 dark:ring-1
        ring-slate-100
        dark:ring-[#132447]
        hover:ring-indigo-200
        dark:hover:ring-indigo-900
        sm:hover:scale-105
        shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
        "
        @mouseenter="cardIsHovering = true"
        @mouseleave="cardIsHovering = false"
        >
        <div class="flex items-center justify-between gap-5">
            <category-pill
                :category="laravelPackage.category"
                @click.stop.prevent="selectedCategory = laravelPackage.category"
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
                class="pt-1.5
                text-sm
                text-[#959BAF]
                dark:text-[#828CAC]
                "
                >
                {{ laravelPackage.description }}
            </div>
        </div>
        <ui-tooltip
            v-if="laravelPackage.detected_compatible_versions.length"
            :content="compatiblityMessage"
            :theme="isCompatibleWithLatestLaravelVersion ? 'emerald' : 'amber'"
            class="text-xs pt-2
            flex items-center gap-1
            "
            >
            <div class="flex gap-2 items-center">
                <div
                    v-if="isCompatibleWithLatestLaravelVersion"
                    class="i-ph-check-circle-duotone text-xl text-emerald-500"
                    />
                <div
                    v-else
                    ref="warningIcon"
                    class="i-ph-warning-circle-duotone text-xl text-amber-500"
                    />
                <div class="">
                    Compatible versions:
                </div>
            </div>
            <div class="flex gap-0.5 items-center">
                <div
                    v-for="version in laravelPackage.detected_compatible_versions"
                    :key="version"
                    >
                    {{ version }}
                    <span v-if="version !== laravelPackage.detected_compatible_versions[laravelPackage.detected_compatible_versions.length - 1]">
                        ,
                    </span>
                </div>
            </div>
        </ui-tooltip>
        <div
            class="flex items-center gap-2
            pt-2
            text-[#505878]
            dark:text-[#BECDF2]
            "
            >
            <div class="i-ph-github-logo-duotone text-xl" />
            <ui-tooltip
                class="text-xs font-medium truncate"
                :content="repoName"
                :condition="repoNameTooltipCondition"
                >
                {{ repoName }}
            </ui-tooltip>
        </div>
    </a>
</template>