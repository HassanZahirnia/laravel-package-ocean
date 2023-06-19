<script setup lang="ts">
import { gsap } from 'gsap'
import * as ScrollTrigger from 'gsap/ScrollTrigger'
import { UAParser } from 'ua-parser-js'
import { laravelPackages } from '@/database/packages'
import { categories } from '@/database/categories'

const parser = new UAParser()
const browserName = parser.getBrowser().name

onMounted(() => {
    if (browserName && /firefox/i.test(browserName))
        return

    gsap.registerPlugin(ScrollTrigger)

    gsap.to('#hero-section .gsap-fox', {
        yPercent: 7,
        scrollTrigger: {
            trigger: 'body',
            scrub: 1.5,
            start: '100px 50px',
            end: 'bottom bottom',
        },
    })
    gsap.to('#hero-section .gsap-hero-card', {
        yPercent: -3,
        scrollTrigger: {
            trigger: 'body',
            scrub: 1,
            start: '100px 50px',
            end: 'bottom bottom',
        },
    })
})

// Get unique count of authors from laravelPackages
const authorsCount = new Set(laravelPackages.map(laravelPackage => laravelPackage.author)).size
</script>

<template>
    <div
        id="hero-section"
        class="relative"
        >
        <!-- Fox -->
        <div
            class="absolute z-[-1]
            top-0 sm:-top-14
            right-1/2
            translate-x-1/2
            "
            >
            <img
                src="@/assets/images/fox.webp"
                width="150"
                height="237"
                alt=""
                class="gsap-fox pointer-events-none select-none"
                />
        </div>
        <!-- Hero text -->
        <div
            class="gsap-hero-card pt-36 px-5 sm:px-10"
            >
            <div
                class="mx-auto w-full max-w-3xl rounded-3xl
                px-5 py-10
                sm:p-10
                text-center
                backdrop-blur-xl
                dark:backdrop-blur-lg
                transition-colors duration-300
                bg-white/30
                dark:bg-[#110E26]/50
                shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
                "
                >
                <!-- Title -->
                <div
                    class="text-2xl sm:text-3xl
                    font-bold
                    text-[#040404] dark:text-white
                    transition duration-300
                    "
                    >
                    Discover new Laravel packages.
                </div>
                <!-- Description -->
                <div
                    class="mx-auto max-w-sm sm:max-w-md
                    pt-5
                    font-medium
                    sm:text-lg
                    transition duration-300
                    text-[#6A7789] dark:text-[#96A5BB]
                    "
                    >
                    Our goal is to help the Laravel community to find new & useful Laravel packages in one place.
                </div>
                <div
                    class="mt-11 sm:mx-10 md:mx-20
                    pt-9
                    flex flex-wrap
                    justify-around md:justify-center
                    border-t border-t-[#6A7789]/20
                    dark:border-t-[#627288]/20
                    gap-5 md:gap-24 min-[450px]:gap-14
                    transition duration-300
                    "
                    >
                    <!-- Packages count -->
                    <div class="space-y-0.5">
                        <div
                            class="text-3xl
                            font-bold
                            text-[#4B6CFF]
                            transition duration-300
                            "
                            >
                            {{ laravelPackages.length }}
                        </div>
                        <div
                            class="text-sm
                            font-medium
                            text-[#827F98] dark:text-[#96A5BB]
                            transition duration-300
                            "
                            >
                            Packages
                        </div>
                    </div>
                    <!-- Authors count -->
                    <div class="space-y-0.5">
                        <div
                            class="text-3xl
                            font-bold
                            text-[#4B6CFF]
                            transition duration-300
                            "
                            >
                            {{ authorsCount }}
                        </div>
                        <div
                            class="text-sm
                            font-medium
                            text-[#827F98] dark:text-[#96A5BB]
                            transition duration-300
                            "
                            >
                            Authors
                        </div>
                    </div>
                    <!-- Categories count -->
                    <div class="space-y-0.5">
                        <div
                            class="text-3xl
                            font-bold
                            text-[#4B6CFF]
                            transition duration-300
                            "
                            >
                            {{ categories.length }}
                        </div>
                        <div
                            class="text-sm
                            font-medium
                            text-[#827F98] dark:text-[#96A5BB]
                            transition duration-300
                            "
                            >
                            Categories
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>