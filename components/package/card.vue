<script setup lang="ts">
import { gsap } from 'gsap'
import { active_laravel_versions } from '@/database/laravel'
import type { Package } from '@/types/package'

const $props = defineProps<{
    laravelPackage: Package
}>()

// Determines whether only official packages should be displayed.
const showOfficialPackages = useShowOfficialPackages()

// Determines which category of packages should be displayed.
const selectedCategory = useSelectedCategory()

// If there are compatible versions, use those.
// Otherwise, use the detected compatible versions.
const compatible_versions = computed(() => $props.laravelPackage.compatible_versions.length
    ? $props.laravelPackage.compatible_versions
    : $props.laravelPackage.detected_compatible_versions)

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

// A function to separate large numbers with commas
// Example: 2600 -> 2,600
function numberWithCommas(num: number): string {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

// Get author and name of repo from the github link
// Example: https://github.com/spatie/once -> spatie/once
const repositoryName = computed(() => {
    const githubLink = $props.laravelPackage.github
    const githubLinkParts = githubLink.split('/')
    const author = githubLinkParts[githubLinkParts.length - 2]
    const repo = githubLinkParts[githubLinkParts.length - 1]
    return `${author}/${repo}`
})

// Determines whether to show a tooltip for long repository names
const showRepositoryNameTooltip = computed(() => repositoryName.value.length > 34 || window.innerWidth < 370)

// Check whether compatible_versions includes the versions from the list active_laravel_versions
const isCompatible = computed(() => {
    const compatibleVersions = compatible_versions.value

    // Here we go through each version and make sure the package is compatible with the active versions.
    // Example: If the package is compatible with Laravel >=9, but the active versions are 9 and 10, it will return true.
    // Example: If the package is compatible with Laravel 8, but the active versions are 9 and 10, it will return false.
    // And so on.
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

// Compatiblity and versions list message
const compatiblity_message = computed(() => {
    if (isCompatible.value)
        return 'Compatible with maintained versions of Laravel.'
    else
        return 'Not compatible with maintained versions of Laravel.'
})

// Star count is over 1k
const isStarCountOver1k = computed(() => formatStars($props.laravelPackage.stars).includes('k'))

// Hover state
const isHovering = ref(false)

// The card DOM node to animate
const card = ref<HTMLElement | null>(null)

// The card animation timeline
let cardTimeline: gsap.core.Timeline | null = null

onMounted(() => {
    cardTimeline = gsap.timeline({
        paused: true,
        onComplete: () => {
            if (!isHovering.value)
                cardTimeline?.reverse()
        },
    })
        // Card
        .to(card.value, {
            y: -4,
            ease: 'sine.out',
            duration: 0.25,
        })
})

watch(
    isHovering,
    (value) => {
        // If hovering, play the animation
        if (value) cardTimeline?.play()
        // If not hovering and animation is done, reverse it
        else if (cardTimeline?.progress() === 1)
            cardTimeline?.reverse()
    })
</script>

<template>
    <div>
        <div
            ref="card"
            @mouseenter="isHovering = true"
            @mouseleave="isHovering = false"
            >
            <a
                :href="laravelPackage.github"
                target="_blank"
                class="rounded-3xl relative group
                h-60
                p-6
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
                <!-- Crown icon -->
                <ui-tooltip
                    v-if="laravelPackage.author === 'laravel'"
                    content="Official Laravel Package"
                    class="absolute -top-3 -left-3"
                    theme="amber"
                    @click.stop.prevent="showOfficialPackages = '1'"
                    >
                    <div
                        class="i-fluent-emoji-crown text-2xl
                        -rotate-45
                        "
                        />
                </ui-tooltip>
                <div class="flex items-center justify-between gap-5">
                    <!-- Category -->
                    <category-pill
                        :category="laravelPackage.category"
                        @click.stop.prevent="selectedCategory = laravelPackage.category"
                        />
                    <!-- Stars -->
                    <div
                        class="flex items-center gap-2"
                        :class="{
                            'transition-transform duration-300 group-hover:-translate-x-2': isStarCountOver1k,
                        }"
                        >
                        <div
                            class="i-fluent-emoji-flat:star w-[1.15rem] h-[1.15rem]
                            transition duration-500 ease-out
                            relative -top-px
                            "
                            :class="{
                                'group-hover:rotate-[-75deg]': isStarCountOver1k,
                            }"
                            />
                        <div class="relative text-sm">
                            <div
                                class=""
                                :class="{
                                    'transition-opacity duration-300 group-hover:opacity-0': isStarCountOver1k,
                                }"
                                >
                                {{ formatStars(laravelPackage.stars) }}
                            </div>
                            <div
                                class="absolute top-0 left-0"
                                :class="{
                                    'transition-opacity duration-300 opacity-0 group-hover:opacity-100': isStarCountOver1k,
                                }"
                                >
                                {{ numberWithCommas(laravelPackage.stars) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 pt-6">
                    <div class="flex gap-2 items-center">
                        <!-- Name -->
                        <div
                            class="font-semibold
                            text-[#545D82]
                            dark:text-[#DEE4F1]
                            "
                            :class="{
                                'text-sm': laravelPackage.name.length > 30,
                            }"
                            >
                            {{ laravelPackage.name }}
                        </div>
                    </div>
                    <!-- Description -->
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
                    class="mt-2 relative
                    text-[#505878]
                    dark:text-[#BECDF2]
                    "
                    >
                    <!-- Repo name -->
                    <div
                        class="flex items-center gap-2
                        transition duration-300
                        "
                        :class="{
                            'group-hover:opacity-0 group-hover:translate-x-2': laravelPackage.composer || laravelPackage.npm,
                        }"
                        >
                        <div class="i-carbon:logo-github text-xl" />
                        <ui-tooltip
                            class="text-xs font-medium truncate"
                            :content="repositoryName"
                            :condition="showRepositoryNameTooltip"
                            >
                            {{ repositoryName }}
                        </ui-tooltip>
                    </div>
                    <!-- Package type -->
                    <div
                        class="absolute top-0 left-0
                        transition duration-300
                        opacity-0 -translate-x-2
                        "
                        :class="{
                            'group-hover:opacity-100 group-hover:translate-x-0': laravelPackage.composer || laravelPackage.npm,
                        }"
                        >
                        <!-- Laravel package -->
                        <ui-tooltip
                            v-if="compatible_versions.length && !laravelPackage.php_only"
                            :content="compatiblity_message"
                            :theme="isCompatible ? 'emerald' : 'amber'"
                            class="text-xs
                            flex items-center gap-1
                            "
                            >
                            <div
                                v-if="isCompatible"
                                class="flex items-center gap-2
                                text-emerald-500"
                                >
                                <!-- Checkmark icon -->
                                <div class="i-ph-check-circle-duotone text-xl" />
                                <div class="text-xs truncate">
                                    Laravel versions:
                                    {{ compatible_versions.join(', ') }}
                                </div>
                            </div>
                            <div
                                v-else
                                class="flex items-center gap-2
                                text-amber-500"
                                >
                                <!-- Warning icon -->
                                <div
                                    class="i-ph-warning-circle-duotone text-xl"
                                    />
                                <div class="text-xs truncate">
                                    Laravel versions:
                                    {{ compatible_versions.join(', ') }}
                                </div>
                            </div>
                        </ui-tooltip>
                        <!-- PHP package -->
                        <ui-tooltip
                            v-if="laravelPackage.php_only && !compatible_versions.length"
                            content="This is a general PHP package. <br> It does not require Laravel."
                            theme="indigo"
                            class="flex items-center gap-2"
                            >
                            <div
                                class="i-svg-elephant text-lg"
                                />
                            <div class="text-xs truncate">
                                PHP package
                            </div>
                        </ui-tooltip>
                        <!-- NPM package -->
                        <ui-tooltip
                            v-if="laravelPackage.npm && !compatible_versions.length && !laravelPackage.php_only"
                            content="This is a NPM package. <br> It doesn't rely on PHP."
                            theme="indigo"
                            class="flex items-center gap-2"
                            >
                            <div
                                class="i-logos:npm-icon"
                                />
                            <div class="text-xs truncate">
                                NPM package
                            </div>
                        </ui-tooltip>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>