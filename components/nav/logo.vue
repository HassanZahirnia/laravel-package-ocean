<script setup lang="ts">
import { gsap } from 'gsap'
import { CustomEase } from 'gsap/all'

gsap.registerPlugin(CustomEase)

const isHovering = ref(false)

let fishTimeline: gsap.core.Timeline | null = null

onMounted(() => {
    fishTimeline = gsap.timeline({
        paused: true,
        onComplete: () => {
            fishTimeline?.pause(0)
        },
    })
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
        .to('.gsap-nav-ocean', {
            keyframes: {
                rotate: [0, 10, 0],
                easeEach: 'none',
            },
            ease: 'bounce.out',
            duration: 1,
        }, '>-0.1')
        .to('.gsap-nav-droplet-1', {
            keyframes: {
                x: [0, 5],
                y: [0, -5],
                autoAlpha: [0, 1, 0],
                scale: [0, 1],
                easeEach: 'none',
            },
            ease: 'power2.out',
            duration: 0.5,
        }, '<')
})

watch(
    isHovering,
    (value) => {
        if (value) {
            if(fishTimeline?.progress() === 0)
                fishTimeline?.play()
        }
        
    })
</script>

<template>
    <div
        @mouseenter="isHovering = true"
        @mouseleave="isHovering = false"
        >
        <nuxt-link
            href="/"
            class="relative flex items-center gap-7"
            aria-label="Home"
            rel="prefetch"
            >
            <!-- Logo -->
            <div class="i-svg-logo gsap-nav-logo text-5xl" />
            <!-- Fish -->
            <div
                class="gsap-nav-fish pointer-events-none
                absolute left-12 -top-6 h-36 w-36 select-none
                opacity-0
                "
                >
                <div
                    class="i-fluent-emoji-fish scale-x-[-1] text-2xl
                    "
                    />
            </div>
            <!-- Droplet -->
            <div
                class="gsap-nav-droplet-1 pointer-events-none
                absolute -right-4 top-5 select-none opacity-0
                "
                >
                <div
                    class="i-fluent-emoji-sweat-droplets -rotate-90 text-2xl
                    "
                    />
            </div>
            <!-- Brand -->
            <div class="text-[#090959] dark:text-inherit">
                <div class="text-lg leading-snug">
                    Laravel
                </div>
                <div class="flex items-center gap-1 text-xl font-bold">
                    <div class="">
                        Package
                    </div>
                    <div class="gsap-nav-ocean bg-gradient-to-r from-cyan-400 to-[#08AFFF] bg-clip-text text-transparent">
                        Ocean
                    </div>
                </div>
            </div>
        </nuxt-link>
    </div>
</template>