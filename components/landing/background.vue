<script setup lang="ts">
import { gsap } from 'gsap'

// Color mode
const colorMode = useColorMode()

// Check if 'light' mode is active
const isLight = computed(() => colorMode.value === 'sepia' || colorMode.value === 'light')

// Animations
onMounted(() => {
    gsap.set('.gsap-background-blur, .gsap-background-blur-opacity-70', {
        autoAlpha: 0,
    })
    gsap.fromTo('.gsap-background-blur', {
        autoAlpha: 0,
    }, {
        autoAlpha: 1,
        duration: 0.3,
    })
    gsap.fromTo('.gsap-background-blur-opacity-70', {
        autoAlpha: 0,
    }, {
        autoAlpha: 0.8,
        duration: 0.3,
    })
})
</script>

<template>
    <!-- Ellipse arc -->
    <div
        class="pointer-events-none select-none rounded-full
        h-[calc(100vw+10rem)] w-[calc(100vw+10rem)]
        scale-y-75 scale-x-150
        absolute -z-10
        -translate-x-1/2
        top-[-80vw] left-1/2
        transition duration-300
        bg-white/20
        dark:bg-[#173563]/10
        "
        />
    <!-- Purple blur -->
    <img
        v-show="!colorMode.unknown && isLight"
        src="@/assets/images/pink-blur.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none select-none
        h-[calc(10rem+35vw)] w-[calc(10rem+35vw)]
        scale-[2.5]
        absolute -z-20
        top-[-10vw] right-[calc(10rem-15vw)] 
        "
        />
    <!-- Purple blur for dark theme -->
    <img
        v-show="!colorMode.unknown && !isLight"
        src="@/assets/images/pink-blur-dark.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none select-none
        h-[calc(10rem+35vw)] w-[calc(10rem+35vw)]
        scale-[2.5] min-[2000px]:scale-[1.7]
        absolute -z-20
        top-[-10vw] right-[calc(10rem-15vw)] 
        "
        />
    <!-- Blue blur -->
    <img
        v-show="!colorMode.unknown && isLight"
        src="@/assets/images/blue-blur.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none select-none
        h-[calc(10rem+40vw)] w-[calc(10rem+40vw)]
        scale-[2.5]
        absolute -z-30
        top-[24rem]
        min-[500px]:top-[clamp(10rem,calc(25rem-30vw),500px)]
        xl:top-[clamp(-25rem,-5vw,calc(-200px-10vw))]
        left-[6vw] min-[600px]:left-[calc(10rem-20vw)]
        "
        />
    <!-- Blue blur for dark theme -->
    <img
        v-show="!colorMode.unknown && !isLight"
        src="@/assets/images/blue-blur-dark.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur-opacity-70 pointer-events-none select-none
        h-[calc(10rem+40vw)] w-[calc(10rem+40vw)]
        scale-[2.5] min-[2000px]:scale-[1.7]
        absolute -z-30
        top-[24rem] left-[6vw]
        min-[500px]:top-[clamp(10rem,calc(25rem-30vw),500px)]
        xl:top-[clamp(-25rem,-5vw,calc(-200px-10vw))]
        min-[600px]:left-[calc(10rem-20vw)]
        "
        />
</template>