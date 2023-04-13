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
        return `Compatible with maintained versions of Laravel:<br> ${compatible_versions.value.join(', ')}`
    else
        return `Not compatible with maintained versions of Laravel:<br> ${compatible_versions.value.join(', ')}`
})

// Hover state
const isHovering = ref(false)

// The card DOM node to animate
const card = ref<HTMLElement | null>(null)

// The warning icon DOM node to animate
const warningIcon = ref<HTMLElement | null>(null)

// The card animation timeline
let cardTimeline: gsap.core.Timeline | null = null

// The warning icon animation timeline
let warningIconTimeline: gsap.core.Timeline | null = null

const dontPlayWarningAnimation = computed(() => isCompatible.value || compatible_versions.value.length === 0)

onMounted(() => {
    cardTimeline = gsap.timeline({
        paused: true,
        onComplete: () => {
            if(!isHovering.value)
                cardTimeline?.reverse()
        },
    })
        // Card
        .to(card.value, {
            y: -4,
            ease: 'sine.out',
            duration: 0.25,
        })

    // Skip the warning animation if the package is compatible
    if(dontPlayWarningAnimation.value)
        return

    warningIconTimeline = gsap.timeline({
        paused: true,
    })
        // Warning icon
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
        // If hovering, play the animation
        if (value) cardTimeline?.play()
        // If not hovering and animation is done, reverse it
        else if(cardTimeline?.progress() === 1)
            cardTimeline?.reverse()

        // Skip the warning animation if the package is compatible
        if(dontPlayWarningAnimation.value)
            return

        // If hovering, play the animation from the beginning
        if (value)
            warningIconTimeline?.play(0)
        // If not hovering, pause the animation at the beginning
        else
            warningIconTimeline?.pause(0)

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
                class="rounded-3xl relative
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
                    <div class="flex items-center gap-2 group">
                        <div
                            class="i-fluent-emoji-flat:star w-[1.15rem] h-[1.15rem]
                            transition duration-500 ease-out
                            group-hover:rotate-[-75deg]
                            relative -top-px
                            "
                            />
                        <div class="text-sm">
                            {{ formatStars(laravelPackage.stars) }}
                        </div>
                    </div>
                </div>
                <div class="flex-1 pt-6">
                    <div class="flex gap-2 items-center">
                        <!-- Compatibility icons -->
                        <ui-tooltip
                            v-if="compatible_versions.length && !laravelPackage.php_only"
                            :content="compatiblity_message"
                            :theme="isCompatible ? 'emerald' : 'amber'"
                            class="text-xs
                            flex items-center gap-1
                            "
                            >
                            <!-- Checkmark -->
                            <div
                                v-if="isCompatible"
                                class="i-logos-laravel text-lg text-emerald-500"
                                />
                            <!-- Warning -->
                            <div
                                v-else
                                ref="warningIcon"
                                class="i-ph-warning-circle-duotone text-xl text-amber-500"
                                />
                        </ui-tooltip>
                        <!-- PHP icon -->
                        <ui-tooltip
                            v-if="laravelPackage.php_only"
                            content="This package is for PHP only <br> It does not require Laravel."
                            theme="indigo"
                            class="text-xs
                            flex items-center gap-1
                            "
                            >
                            <div
                                class="i-svg-elephant text-lg"
                                />
                        </ui-tooltip>
                        <!-- Name -->
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
                <!-- Repo name -->
                <div
                    class="flex items-center gap-2
                    pt-2
                    text-[#505878]
                    dark:text-[#BECDF2]
                    "
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
            </a>
        </div>
    </div>
</template>