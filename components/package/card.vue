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
    return compatible_versions.value.some((version) => {
        if (version.includes('+')) {
            const baseVersion = version.slice(0, -1)
            return active_laravel_versions.some((activeVersion) => {
                return activeVersion >= baseVersion
            })
        }
        else if (version.includes('-')) {
            const [startVersion, endVersion] = version.split('-')
            return active_laravel_versions.some((activeVersion) => {
                return activeVersion >= startVersion && activeVersion <= endVersion
            })
        }
        else {
            return active_laravel_versions.includes(version)
        }
    })
})


// Compatiblity and verions list message
const compatiblity_message = computed(() => {
    if (package_is_compatible_with_latest_laravel_version.value)
        return `Compatible with maintained versions of Laravel: ${compatible_versions.value.join(', ')}`
    else
        return `Not compatible with maintained versions of Laravel: ${compatible_versions.value.join(', ')}`
})

// Warning icon animation
const card_is_hovering = ref(false)
const warningIcon = ref<HTMLElement | null>(null)
const should_not_animate_warning_icon = computed(() => package_is_compatible_with_latest_laravel_version.value || compatible_versions.value.length === 0)
let warningIconTimeline: gsap.core.Timeline | null = null

onMounted(() => {
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
    card_is_hovering,
    (value) => {
        if(should_not_animate_warning_icon.value) 
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
        hover:ring-indigo-200
        dark:hover:ring-indigo-900
        sm:hover:scale-105
        shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
        "
        @mouseenter="card_is_hovering = true"
        @mouseleave="card_is_hovering = false"
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
                        class="i-ph-check-circle-duotone text-2xl text-emerald-500"
                        />
                    <div
                        v-else
                        ref="warningIcon"
                        class="i-ph-warning-circle-duotone text-2xl text-amber-500"
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
</template>