<script setup lang="ts">
import { gsap } from 'gsap'
import { active_laravel_versions } from '@/database/laravel-versions'
import type { Package } from '@/types/package'

const $props = defineProps<{
    laravelPackage: Package
}>()

const compatible_versions = computed(() => $props.laravelPackage.compatible_versions.length
    ? $props.laravelPackage.compatible_versions
    : $props.laravelPackage.detected_compatible_versions)

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
const github_repository_name = computed(() => {
    const githubLink = $props.laravelPackage.github
    const githubLinkParts = githubLink.split('/')
    const author = githubLinkParts[githubLinkParts.length - 2]
    const repo = githubLinkParts[githubLinkParts.length - 1]
    return `${author}/${repo}`
})

const show_github_repository_name = computed(() => github_repository_name.value.length > 34 || window.innerWidth < 370)

// Check whether compatible_versions includes the versions from the list active_laravel_versions
const package_is_compatible_with_latest_laravel_version = computed(() => {
    const compatibleVersions = compatible_versions.value
    return active_laravel_versions.some((activeVersion) => {
        return compatibleVersions.some((compatibleVersion) => {
            const match = compatibleVersion.match(/^([<>]=?|>=|<=)(\d+)$/)
            if (!match) 
                return activeVersion === compatibleVersion
      
            const operator = match[1]
            const version = parseInt(match[2])
            if (operator === '') 
                return activeVersion === compatibleVersion
      
            else if (operator === '>=') 
                return parseInt(activeVersion) >= version
      
            else if (operator === '<=') 
                return parseInt(activeVersion) <= version
      
            else if (operator === '>') 
                return parseInt(activeVersion) > version
      
            else if (operator === '<') 
                return parseInt(activeVersion) < version
      
            return false
        })
    })
})


// Compatiblity and verions list message
const compatiblity_message = computed(() => {
    if (package_is_compatible_with_latest_laravel_version.value)
        return `Compatible with maintained versions of Laravel: ${compatible_versions.value.join(', ')}`
    else
        return `Not compatible with maintained versions of Laravel: ${compatible_versions.value.join(', ')}`
})

const isHovering = ref(false)
// Warning icon animation
const card = ref<HTMLElement | null>(null)
const warningIcon = ref<HTMLElement | null>(null)
let cardTimeline: gsap.core.Timeline | null = null
let warningIconTimeline: gsap.core.Timeline | null = null

const should_not_animate_warning_icon = computed(() => package_is_compatible_with_latest_laravel_version.value || compatible_versions.value.length === 0)

onMounted(() => {
    cardTimeline = gsap.timeline({
        paused: true,
        onComplete: () => {
            if(!isHovering.value)
                cardTimeline?.reverse()
        },
    })
        .to(card.value, {
            y: -4,
            ease: 'sine.out',
            duration: 0.25,
        })

    if(should_not_animate_warning_icon.value) 
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
    isHovering,
    (value) => {
        if (value) cardTimeline?.play() 
        else if(cardTimeline?.progress() === 1)
            cardTimeline?.reverse()

        if(should_not_animate_warning_icon.value) 
            return
            
        if (value) 
            warningIconTimeline?.play(0)
        else
            warningIconTimeline?.pause(0)
        
    })
</script>

<template>
    <div
        ref="card"
        @mouseenter="isHovering = true"
        @mouseleave="isHovering = false"
        >
        <a
            :href="laravelPackage.github"
            target="_blank"
            class="rounded-3xl relative
            h-60
            p-6
            backdrop-blur-xl
            transition duration-300
            flex flex-col
            bg-white/50
            dark:bg-[#362B59]/20
            ring-1 dark:ring-1
            ring-slate-100
            dark:ring-[#132447]
            dark:hover:ring-indigo-900
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            hover:shadow-2xl hover:shadow-slate-700/10
            "
            >
            <ui-tooltip
                v-if="laravelPackage.author === 'laravel'"
                content="Official Laravel Package"
                class="absolute -top-4 -left-4"
                theme="amber"
                >
                <div
                    class="i-fluent-emoji-crown text-3xl
                    -rotate-45
                    "
                    />
            </ui-tooltip>
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
                <div class="flex gap-2 items-center">
                    <ui-tooltip
                        v-if="compatible_versions.length"
                        :content="compatiblity_message"
                        :theme="package_is_compatible_with_latest_laravel_version ? 'emerald' : 'amber'"
                        class="text-xs
                        flex items-center gap-1
                        "
                        >
                        <div
                            v-if="package_is_compatible_with_latest_laravel_version"
                            class="i-ph-check-circle-duotone text-xl text-emerald-500"
                            />
                        <div
                            v-else
                            ref="warningIcon"
                            class="i-ph-warning-circle-duotone text-xl text-amber-500"
                            />
                    </ui-tooltip>
                    <div
                        class="font-semibold
                        text-[#545D82]
                        dark:text-[#DEE4F1]
                        "
                        :class="{
                            'text-sm': laravelPackage.name.length > 25,
                        }"
                        >
                        {{ laravelPackage.name }}
                    </div>
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
                    :content="github_repository_name"
                    :condition="show_github_repository_name"
                    >
                    {{ github_repository_name }}
                </ui-tooltip>
            </div>
        </a>
    </div>
</template>