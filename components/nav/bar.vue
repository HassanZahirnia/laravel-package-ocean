<script setup lang="ts">
import { gsap } from 'gsap'

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
</script>

<template>
    <nav
        class="relative z-50
        mx-auto w-full max-w-screen-xl
        "
        >
        <header
            class="px-5 py-10
            flex gap-5
            items-center
            justify-center sm:justify-between
            "
            >
            <!-- Logo and brand name -->
            <nav-logo />
            <div
                class="hidden sm:flex
                gap-1
                items-center
                "
                >
                <!-- Suggest a new package -->
                <a
                    href="https://github.com/HassanZahirnia/laravel-package-ocean"
                    target="_blank"
                    class="mr-1
                    select-none rounded-xl
                    backdrop-blur-xl
                    transition duration-300
                    px-5 py-3
                    text-sm
                    font-medium
                    bg-white/30 dark:bg-transparent
                    hover:bg-white/40
                    dark:hover:bg-[#110E26]/40
                    text-[#404a6b]
                    hover:text-slate-900
                    dark:text-[#ABB0DD]
                    shadow-lg shadow-fuchsia-100/70
                    hover:shadow-xl hover:shadow-fuchsia-100
                    dark:shadow-none
                    ring-1 ring-slate-200/20
                    dark:ring-[#627288]/40
                    "
                    >
                    Suggest a new package
                </a>
                <!-- Github link -->
                <a
                    class="select-none
                    p-2
                    transition duration-300
                    hover:text-slate-600
                    dark:text-[#ABB0DD]
                    dark:hover:text-[#bcc1ef]
                    "
                    href="https://github.com/HassanZahirnia/laravel-package-ocean"
                    target="_blank"
                    aria-label="Github"
                    >
                    <div class="i-carbon-logo-github text-3xl" />
                </a>
                <!-- Theme toggle  -->
                <label
                    class="gsap-theme-toggle relative -top-px scale-0 cursor-pointer
                    p-2
                    "
                    @mouseenter="themeIsHovering = true"
                    @mouseleave="themeIsHovering = false"
                    >
                    <input
                        v-model="themeCheckbox"
                        class="toggle
                        z-[1]
                        cursor-pointer select-none appearance-none
                        border-none
                        bg-transparent
                        "
                        type="checkbox"
                        aria-label="Theme toggle"
                        />
                </label>
            </div>
        </header>
    </nav>
</template>

<style scoped lang="stylus">
.toggle
    --size: 1.45rem;
    outline: none !important;
    width: var(--size);
    height: var(--size);
    box-shadow: inset calc(var(--size) * 0.33) calc(var(--size) * -0.25) 0
    border-radius: 999px;
    color: #ABB0DD;
    transition: all 300ms;
    &:focus
        box-shadow: inset calc(var(--size) * 0.33) calc(var(--size) * -0.25) 0
.toggle:checked {
    --ray-size: calc(var(--size) * -0.4);
    --offset-orthogonal: calc(var(--size) * 0.7);
    --offset-diagonal: calc(var(--size) * 0.5);
    transform: scale(0.75);
    color: #ffb051;
    box-shadow: inset 0 0 0 var(--size), calc(var(--offset-orthogonal) * -1) 0 0 var(--ray-size), var(--offset-orthogonal) 0 0 var(--ray-size), 0 calc(var(--offset-orthogonal) * -1) 0 var(--ray-size), 0 var(--offset-orthogonal) 0 var(--ray-size), calc(var(--offset-diagonal) * -1) calc(var(--offset-diagonal) * -1) 0 var(--ray-size), var(--offset-diagonal) var(--offset-diagonal) 0 var(--ray-size), calc(var(--offset-diagonal) * -1) var(--offset-diagonal) 0 var(--ray-size), var(--offset-diagonal) calc(var(--offset-diagonal) * -1) 0 var(--ray-size);
}
</style>