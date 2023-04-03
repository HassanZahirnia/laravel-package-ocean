<script setup lang="ts">
import { gsap } from 'gsap'

let timeline: gsap.core.Timeline | null = null

const moon = ref<HTMLElement|null>(null)
const miniStar = ref<HTMLElement|null>(null)
const microStar = ref<HTMLElement|null>(null)
const sunBall = ref<HTMLElement|null>(null)
const sunShine = ref<HTMLElement|null>(null)

const colorMode = useColorMode()
const themeIsHovering = ref(false)
const themIsUnknown = computed(() => colorMode.unknown)

const currentThemeMode = computed(() => {
    return (colorMode.value === 'sepia' || colorMode.value === 'light') ? true : false
})

const themeCheckbox = ref(currentThemeMode.value)

watch(
    themeCheckbox,
    (value) => {
        colorMode.preference = value ? 'light' : 'dark'
        if (!value) timeline?.play()
        else timeline?.reverse()
    },
)

watch(
    themIsUnknown,
    (value) => {
        if(!value) {
            gsap.to('.gsap-theme-toggle', {
                scale: 1,
                duration: 0.1,
            })
        }
    },
    {
        immediate: true,
    },
)

watch(
    themeIsHovering,
    (value) => {
        if(value) {
            gsap.to('.gsap-theme-toggle', {
                rotate: -12,
                duration: 0.3,
            })
        }
        else{
            gsap.to('.gsap-theme-toggle', {
                rotate: 0,
                duration: 0.3,
            })
        }
    },
)

watch(
    currentThemeMode,
    (value) => {
        themeCheckbox.value = value
    },
)

onMounted(() => {
    timeline = gsap.timeline({
        paused: true,
    })
        .to(moon.value, {
            rotate: 70,
            ease: 'sine.out',
            duration: 0.3,
        })
        .to(miniStar.value, {
            autoAlpha: 0,
            scale: 0,
            ease: 'sine.out',
            duration: 0.3,
        }, '>-0.3')
        .to(microStar.value, {
            autoAlpha: 0,
            scale: 0,
            ease: 'sine.out',
            duration: 0.3,
        }, '<')
        .to(moon.value, {
            scale: 0.6,
            ease: 'sine.out',
            duration: 0.3,
        }, '<')
        .fromTo(sunBall.value, {
            scale: 0,
            x: -5,
            y: 5,
        }, {
            x: 0,
            y: 0,
            scale: 1,
            ease: 'expo.out',
            duration: 0.3,
        }, '>-0.15')
        .fromTo(sunShine.value, {
            // autoAlpha: 0,
            scale: 0,
            rotate: -180,
        }, {
            // autoAlpha: 1,
            scale: 1,
            rotate: 0,
            ease: 'expo.out',
            duration: 0.3,
        }, '<')

    if (colorMode.preference === 'dark')
        timeline.progress(1)
})
</script>

<template>
    <div
        class="gsap-theme-toggle
        cursor-pointer select-none
        h-10 w-10
        relative
        sm:scale-0
        dark:hover:text-[#bcc1ef]
        "
        @click="themeCheckbox = !themeCheckbox"
        >
        <!-- Moon -->
        <div
            ref="moon"
            class="absolute
            top-1/2 -translate-y-1/2
            right-1/2 translate-x-1/2
            "
            >
            <div class="i-bi-moon-fill text-2xl scale-x-[-1] transition duration-300" />
        </div>
        <!-- Mini star -->
        <div
            ref="miniStar"
            class="absolute
            top-[.45rem]
            left-[.45rem]
            "
            >
            <div class="i-ph-star-four-fill text-[0.45rem] transition duration-300" />
        </div>
        <!-- Micro star -->
        <div
            ref="microStar"
            class="absolute
            top-[0.85rem]
            left-[0.85rem]
            "
            >
            <div class="i-ph-star-four-fill text-[0.35rem] transition duration-300" />
        </div>
        <!-- Sun ball -->
        <div
            class="absolute
            top-1/2 -translate-y-1/2
            right-1/2 translate-x-1/2
            "
            >
            <div ref="sunBall">
                <div
                    class="h-4 w-4 rounded-full
                    bg-current
                    transition duration-300
                    "
                    />
            </div>
        </div>
        <!-- sunShine -->
        <div
            ref="sunShine"
            class="grid
            absolute
            inset-0 w-full h-full
            "
            >
            <div class="relative w-full h-full">
                <!-- Top -->
                <div
                    class="h-[0.22rem] w-0.5 rounded-full
                    absolute
                    top-[0.35rem]
                    right-1/2 translate-x-1/2
                    bg-current
                    transition duration-300
                    "
                    />
                <!-- Top Right -->
                <div
                    class="h-[0.22rem] w-0.5 rounded-full
                    absolute
                    top-[0.6rem]
                    right-[0.65rem]
                    rotate-[45deg]
                    bg-current
                    transition duration-300
                    "
                    />
                <!-- Top Left -->
                <div
                    class="h-[0.22rem] w-0.5 rounded-full
                    absolute
                    top-[0.6rem]
                    left-[0.65rem]
                    rotate-[-45deg]
                    bg-current
                    transition duration-300
                    "
                    />
                <!-- Right -->
                <div
                    class="h-[0.22rem] w-0.5 rounded-full
                    absolute
                    top-1/2 -translate-y-1/2
                    right-[0.35rem]
                    rotate-[90deg]
                    bg-current
                    transition duration-300
                    "
                    />
                <!-- Bottom -->
                <div
                    class="h-[0.22rem] w-0.5 rounded-full
                    absolute
                    bottom-[0.35rem]
                    right-1/2 translate-x-1/2
                    bg-current
                    transition duration-300
                    "
                    />
                <!-- Bottom Right -->
                <div
                    class="h-[0.22rem] w-0.5 rounded-full
                    absolute
                    bottom-[0.6rem]
                    right-[0.65rem]
                    rotate-[-45deg]
                    bg-current
                    transition duration-300
                    "
                    />
                <!-- Bottom Left -->
                <div
                    class="h-[0.22rem] w-0.5 rounded-full
                    absolute
                    bottom-[0.6rem]
                    left-[0.65rem]
                    rotate-[45deg]
                    bg-current
                    transition duration-300
                    "
                    />
                <!-- Left -->
                <div
                    class="h-[0.22rem] w-0.5 rounded-full
                    absolute
                    top-1/2 -translate-y-1/2
                    left-[0.35rem]
                    rotate-[90deg]
                    bg-current
                    transition duration-300
                    "
                    />
            </div>
        </div>
    </div>
</template>