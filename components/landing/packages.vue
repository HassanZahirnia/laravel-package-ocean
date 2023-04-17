<script setup lang="ts">
import { gsap } from 'gsap'

// Color mode
const colorMode = useColorMode()

// Check if 'light' mode is active
const isLight = computed(() => colorMode.value === 'sepia' || colorMode.value === 'light')

// Animations
onMounted(() => {
    gsap.set('.gsap-emerald-background-blur', {
        autoAlpha: 0,
    })
    gsap.fromTo('.gsap-emerald-background-blur', {
        autoAlpha: 0,
    }, {
        autoAlpha: 1,
        duration: 0.3,
    })
})
</script>

<template>
    <div
        class="relative px-5 pt-10 text-[#273240]
        dark:text-[#EAEFFB]
        "
        >
        <!-- Emerald background -->
        <div
            class="gsap-emerald-background-blur
            absolute -z-40
            top-1/2 right-1/2
            -translate-y-1/2 translate-x-1/2
            h-[calc(10rem+35vw)] w-[calc(10rem+35vw)]
            scale-[2.5]
            "
            >
            <img
                v-show="!colorMode.unknown"
                src="@/assets/images/emerald-blur.webp"
                width="auto"
                height="auto"
                alt=""
                class="pointer-events-none select-none
                w-full h-full
                transition duration-300
                "
                :class="{
                    'opacity-60': !isLight,
                }"
                />
        </div>
        <!-- Categories & Packages list -->
        <ClientOnly
            fallback-tag="span"
            fallback=""
            >
            <div
                class="fade-in relative
                flex items-start gap-5
                "
                >
                <category-list />
                <package-list />
            </div>
        </ClientOnly>
    </div>
</template>

<style scoped lang="stylus">
.fade-in {
  animation-name: fade-in;
  animation-duration: 0.3s;
  animation-timing-function: ease-out;
}

@keyframes fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

</style>