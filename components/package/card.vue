<script setup lang="ts">
import { gsap } from 'gsap'
import semver from 'semver'
import lodash from 'lodash'
import { active_laravel_versions } from '@/database/laravel'
import type { Package } from '@/types/package'

const $props = defineProps<{
    laravelPackage: Package
}>()

const { orderBy } = lodash

// Sort active laravel versions from highest to lowest
const sorted_active_laravel_versions = reactiveComputed(() => orderBy(active_laravel_versions, version => parseInt(version), 'desc'))

// Determines whether only official packages should be displayed.
const showOfficialPackages = useShowOfficialPackages()

// Determines which category of packages should be displayed.
const selectedCategory = useSelectedCategory()

const minimum_compatible_version = computed(() => {
    let lowestMinVersion = ''
    const minVersions = new Set<string>()

    // Go through each laravel_dependency_versions and find the minimum version
    for (const version of $props.laravelPackage.laravel_dependency_versions) {
        const min = semver.minVersion(version)?.version
        if (min)
            minVersions.add(min)
    }

    // Compare each minimum version with eachother, and get the lowest one
    for (const version of minVersions) {
        let isLowest = true
        for (const otherVersion of minVersions) {
            if (semver.gt(version, otherVersion)) {
                isLowest = false
                break
            }
        }
        if (isLowest)
            lowestMinVersion = version
    }

    // Remove any .0 or .0.0 from the end of the version
    lowestMinVersion = lowestMinVersion.replace(/\.0+$/, '').replace(/\.0+$/, '')

    return lowestMinVersion
})

const maximum_compatible_version = computed(() => {
    let highestMaxVersion = ''

    if (!minimum_compatible_version.value.length)
        return highestMaxVersion

    // Go through each sorted_active_laravel_versions starting from the highest
    // and see if it satisfies any of the version ranges in the laravel_dependency_versions array
    // and among those versions, find the highest one
    for (let i = sorted_active_laravel_versions.length - 1; i >= 0; i--) {
        for (const compatibleVersion of $props.laravelPackage.laravel_dependency_versions) {
            const activeVersion = sorted_active_laravel_versions[i]
            const majorActiveVersion = semver.major(activeVersion)
            if (semver.subset(activeVersion, compatibleVersion)
                || semver.satisfies(`${majorActiveVersion}.0.0`, compatibleVersion)) {
                highestMaxVersion = activeVersion
                break
            }
        }
    }

    // Remove any .0 or .0.0 from the end of the version
    highestMaxVersion = highestMaxVersion.replace(/\.0+$/, '').replace(/\.0+$/, '')

    return highestMaxVersion
})

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

// Check whether laravel_dependency_versions includes the versions from the list sorted_active_laravel_versions
const isCompatible = computed(() => {
    return sorted_active_laravel_versions.some((activeVersion) => {
        return $props.laravelPackage.laravel_dependency_versions.some((compatibleVersion) => {
            const convertedActiveVersion = semver.valid(semver.coerce(activeVersion)) as string
            const majorActiveVersion = semver.major(convertedActiveVersion)
            return semver.satisfies(convertedActiveVersion, compatibleVersion)
                || semver.satisfies(`${majorActiveVersion}.0.0`, compatibleVersion)
        })
    })
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
            y: -1,
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
                class="rounded-3xl relative z-[1] group
                h-60
                p-6
                transition-all duration-300
                flex flex-col
                bg-white/40
                hover:bg-white/60
                dark:bg-[#362B59]/20
                dark:hover:bg-[#362B59]/30
                ring-1 dark:ring-1
                ring-slate-100
                hover:ring-white
                dark:ring-[#132447]
                dark:hover:ring-[#373060]
                shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
                hover:shadow-2xl
                hover:shadow-indigo-300/30
                dark:hover:shadow-xl
                dark:hover:shadow-[#1c164a]
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
                        <ui-tooltip
                            v-if="laravelPackage.paid_integration"
                            content="This package integrates with a paid service."
                            theme="indigo"
                            >
                            <div class="i-bx:bxs-dollar-circle text-[1.3rem] text-yellow-500" />
                        </ui-tooltip>
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
                        transition duration-300 ease-out
                        group-hover:opacity-0 group-hover:translate-x-5 group-hover:translate-y-5
                        "
                        >
                        <div class="i-carbon:logo-github text-xl" />
                        <div class="text-xs font-medium truncate">
                            {{ repositoryName }}
                        </div>
                    </div>
                    <!-- Package type -->
                    <div
                        class="absolute left-0 w-full truncate
                        transition duration-300 ease-out
                        flex gap-2 items-center
                        opacity-0 -translate-x-5 -translate-y-5
                        group-hover:opacity-100
                        group-hover:translate-x-0 group-hover:translate-y-0
                        "
                        :class="{
                            'top-0': !laravelPackage.laravel_dependency_versions.length,
                            '-top-2': laravelPackage.laravel_dependency_versions.length,
                        }"
                        >
                        <div class="leading-loose">
                            <!-- Laravel icon -->
                            <div
                                v-if="laravelPackage.package_type === 'laravel-package'"
                                class="i-logos:laravel text-[1.3rem]"
                                />
                            <!-- PHP icon -->
                            <div
                                v-if="laravelPackage.package_type === 'php-package'"
                                class="i-svg-elephant text-[1.3rem]"
                                />
                            <!-- NPM icon -->
                            <div
                                v-if="laravelPackage.package_type === 'npm-package'"
                                class="i-logos:npm-icon text-xl"
                                />
                            <!-- Mac icon -->
                            <div
                                v-if="laravelPackage.package_type === 'mac-app'"
                                class="i-logos:apple?mask text-[1.35rem] dark:text-white"
                                />
                            <!-- Windows icon -->
                            <div
                                v-if="laravelPackage.package_type === 'windows-app'"
                                class="i-logos:microsoft-windows text-lg"
                                />
                            <!-- All operating systems icon -->
                            <div
                                v-if="laravelPackage.package_type === 'all-operating-systems-app'"
                                class="i-carbon:software-resource-cluster text-2xl"
                                />
                            <!-- IDE Extension icon -->
                            <div
                                v-if="laravelPackage.package_type === 'ide-extension'"
                                class="i-ph:code text-2xl"
                                />
                        </div>
                        <div class="">
                            <div class="text-sm font-bold">
                                <div v-if="laravelPackage.package_type === 'laravel-package'">
                                    Laravel package
                                </div>
                                <div v-if="laravelPackage.package_type === 'php-package'">
                                    PHP package
                                </div>
                                <div v-if="laravelPackage.package_type === 'npm-package'">
                                    NPM package
                                </div>
                                <div v-if="laravelPackage.package_type === 'mac-app'">
                                    Mac app
                                </div>
                                <div v-if="laravelPackage.package_type === 'windows-app'">
                                    Windows app
                                </div>
                                <div v-if="laravelPackage.package_type === 'all-operating-systems-app'">
                                    All operating systems app
                                </div>
                                <div v-if="laravelPackage.package_type === 'ide-extension'">
                                    IDE Extension/Plugin
                                </div>
                            </div>
                            <div class="text-xs opacity-80">
                                <div
                                    v-if="laravelPackage.laravel_dependency_versions.length && isCompatible"
                                    >
                                    <span
                                        v-if="minimum_compatible_version
                                            && maximum_compatible_version
                                            && minimum_compatible_version !== maximum_compatible_version
                                        "
                                        class="inline-flex items-center gap-1"
                                        >
                                        <span>
                                            {{ 'v' + minimum_compatible_version }}
                                        </span>
                                        <span class="i-heroicons:arrow-long-right text-xl inline-block" />
                                        <span>
                                            {{ 'v' + maximum_compatible_version }}
                                        </span>
                                        <span>
                                            supported
                                        </span>
                                    </span>
                                    <span v-else>
                                        <span>
                                            {{ 'v' + minimum_compatible_version }}
                                        </span>
                                        <span>
                                            supported
                                        </span>
                                    </span>
                                </div>
                                <div
                                    v-if="laravelPackage.laravel_dependency_versions.length && !isCompatible"
                                    class="text-amber-600"
                                    >
                                    Incompatible with maintained versions!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>