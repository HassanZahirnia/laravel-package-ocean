<script setup lang="ts">
import { gsap } from 'gsap'

const colorMode = useColorMode()

const isLight = computed(() => colorMode.value === 'sepia' || colorMode.value === 'light')

onMounted(() => {
    gsap.set('.gsap-background-blur', {
        autoAlpha: 0,
    })
    gsap.fromTo('.gsap-background-blur', {
        autoAlpha: 0,
    }, {
        autoAlpha: 1,
        duration: 0.3,
    })
})
</script>

<template>
    <!-- Ellipse arc -->
    <div
        class="pointer-events-none absolute top-[-70vw] left-1/2
        -z-10 h-[calc(100vw+10rem)] w-[calc(100vw+10rem)] -translate-x-1/2
        scale-y-75
        scale-x-150
        select-none rounded-full
        bg-white/20 transition
        duration-300 dark:bg-[#173563]/10
        min-[2000px]:top-[-80vw]
        "
        />
    <!-- Purple blur -->
    <img
        v-show="!colorMode.unknown && isLight"
        src="@/assets/images/pink-blur.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none absolute top-[-10vw]
        right-[calc(10rem-15vw)] -z-20 h-[calc(10rem+35vw)] w-[calc(10rem+35vw)]
        scale-[2.5] select-none
        "
        />
    <img
        v-show="!colorMode.unknown && !isLight"
        src="@/assets/images/pink-blur-dark.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none absolute top-[-10vw]
        right-[calc(10rem-15vw)] -z-20 h-[calc(10rem+35vw)] w-[calc(10rem+35vw)]
        scale-[2.5] select-none opacity-90 min-[2000px]:scale-[1.7]
        "
        />
    <!-- Blue blur -->
    <img
        v-show="!colorMode.unknown && isLight"
        src="@/assets/images/blue-blur.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none absolute bottom-[calc(5rem-10vw)]
        left-[calc(10rem-20vw)] -z-30 h-[calc(10rem+40vw)] w-[calc(10rem+40vw)]
        scale-[2.5] select-none
        "
        />
    <img
        v-show="!colorMode.unknown && !isLight"
        src="@/assets/images/blue-blur-dark.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none absolute bottom-[calc(5rem-10vw)] left-[calc(10rem-20vw)]
        -z-30 h-[calc(10rem+40vw)] w-[calc(10rem+40vw)] scale-[2.5]
        select-none opacity-60 min-[2000px]:scale-[1.7]
        "
        />
</template>