<script setup lang="ts">
import { gsap } from 'gsap'
import { CustomEase } from 'gsap/all'

gsap.registerPlugin(CustomEase)

// Hover state
const isHovering = ref(false)

// Fish animation timeline
let fishTimeline: gsap.core.Timeline | null = null

// Animations
onMounted(() => {
    fishTimeline = gsap.timeline({
        paused: true,
        onComplete: () => {
            // Reset the timeline when it is complete
            fishTimeline?.pause(0)
        },
    })
        // Logo
        .to('.gsap-nav-logo', {
            keyframes: {
                rotate: [0, 20, 0],
                easeEach: 'none',
            },
            ease: 'power4.out',
            duration: 1.5,
        })
        // Fish
        .to('.gsap-nav-fish', {
            keyframes: {
                '0%': { autoAlpha: 0, rotate: -15 },
                '10%': { autoAlpha: 1 },
                '90%': { autoAlpha: 1 },
                '100%': { autoAlpha: 0, rotate: 80 },
                'easeEach': 'none',
            },
            transformOrigin: 'bottom',
            ease: CustomEase.create('custom', 'M0,0 C0,0.302 1,0.7 1,1 '),
            duration: 0.8,
        }, '<')
        // Ocean
        .to('.gsap-nav-ocean', {
            keyframes: {
                rotate: [0, 10, 0],
                easeEach: 'none',
            },
            ease: 'bounce.out',
            duration: 1,
        }, '>-0.1')
        // Droplet
        .to('.gsap-nav-droplet-1', {
            keyframes: {
                '0%': { autoAlpha: 0, x: 0, y: 0, scale: 0 },
                '10%': { autoAlpha: 1 },
                '90%': { autoAlpha: 1 },
                '100%': { autoAlpha: 0, x: 10, y: -10, scale: 1 },
                'easeEach': 'none',
            },
            ease: 'expo.out',
            duration: 0.4,
        }, '<')
})

watch(
    isHovering,
    (value) => {
        if (value) {
            // Play the timeline from the beginning if it's not already playing
            if(fishTimeline?.progress() === 0)
                fishTimeline?.play()
            // Play the timeline from the beginning if it's past the halfway point
            if(fishTimeline && fishTimeline?.progress() >= 0.5)
                fishTimeline?.play(0)
        }
        
    })
</script>

<template>
    <div
        @mouseenter="isHovering = true"
        @mouseleave="isHovering = false"
        >
        <nuxt-link
            to="/"
            class="relative
            flex items-center gap-7
            "
            aria-label="Home"
            >
            <!-- Logo -->
            <div
                class="i-svg-logo
                gsap-nav-logo
                text-[3.3rem]
                "
                />
            <!-- Fish -->
            <div
                class="gsap-nav-fish pointer-events-none select-none
                h-36 w-36
                absolute
                left-12 -top-6
                opacity-0
                "
                >
                <div
                    class="i-fluent-emoji-fish
                    scale-x-[-1]
                    text-2xl
                    "
                    />
            </div>
            <!-- Droplet -->
            <div
                class="gsap-nav-droplet-1 pointer-events-none select-none
                absolute
                -right-3 top-6
                opacity-0
                "
                >
                <div
                    class="i-fluent-emoji-sweat-droplets
                    -rotate-90
                    text-xl
                    "
                    />
            </div>
            <!-- Brand name -->
            <div class="text-[#090959] dark:text-inherit">
                <div class="text-lg leading-snug">
                    Laravel
                </div>
                <div
                    class="flex items-center gap-1
                    text-xl font-bold
                    "
                    >
                    <div class="">
                        Package
                    </div>
                    <div
                        class="gsap-nav-ocean
                        bg-gradient-to-r from-cyan-400 to-[#08AFFF]
                        bg-clip-text text-transparent
                        "
                        >
                        Ocean
                    </div>
                </div>
            </div>
        </nuxt-link>
    </div>
</template>