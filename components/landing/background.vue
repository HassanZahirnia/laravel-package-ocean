<script setup lang="ts">
import { gsap } from 'gsap'

const colorMode = useColorMode()
const isLight = computed(() => colorMode.value === 'sepia' || colorMode.value === 'light')

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
        class="pointer-events-none absolute top-[-80vw] left-1/2
        -z-10 h-[calc(100vw+10rem)] w-[calc(100vw+10rem)] -translate-x-1/2
        scale-y-75
        scale-x-150
        select-none rounded-full
        bg-white/20 transition
        duration-300 dark:bg-[#173563]/10
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
        scale-[2.5] select-none min-[2000px]:scale-[1.7]
        "
        />
    <!-- Blue blur -->
    <img
        v-show="!colorMode.unknown && isLight"
        src="@/assets/images/blue-blur.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur
        pointer-events-none
        absolute
        top-[24rem]
        left-[6vw]
        -z-30
        h-[calc(10rem+40vw)]
        w-[calc(10rem+40vw)]
        scale-[2.5]
        select-none
        min-[500px]:top-[clamp(10rem,calc(25rem-30vw),500px)]
        min-[600px]:left-[calc(10rem-20vw)]
        xl:top-[clamp(-25rem,-5vw,calc(-200px-10vw))]
        "
        />
    <img
        v-show="!colorMode.unknown && !isLight"
        src="@/assets/images/blue-blur-dark.webp"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur-opacity-70
        pointer-events-none
        absolute
        top-[24rem]
        left-[6vw]
        -z-30
        h-[calc(10rem+40vw)]
        w-[calc(10rem+40vw)]
        scale-[2.5]
        select-none
        min-[500px]:top-[clamp(10rem,calc(25rem-30vw),500px)]
        min-[600px]:left-[calc(10rem-20vw)]
        xl:top-[clamp(-25rem,-5vw,calc(-200px-10vw))]
        min-[2000px]:scale-[1.7]
        "
        />
</template>