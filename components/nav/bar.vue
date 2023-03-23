<script setup lang="ts">
const colorMode = useColorMode()

const currentThemeMode = computed(() => {
    return (colorMode.preference === 'system' || colorMode.preference === 'sepia' || colorMode.preference === 'light') ? true : false
})

const themeCheckbox = ref(currentThemeMode.value)

watch(
    themeCheckbox,
    (value) => {
        colorMode.preference = value ? 'light' : 'dark'
    },
)
</script>

<template>
    <nav class="relative z-50 mx-auto w-full max-w-screen-xl">
        <header
            class="flex items-center justify-center gap-5
            px-5 pt-5 pb-10 sm:justify-between sm:py-10 xl:px-0
            "
            >
            <!-- Logo and brand name -->
            <nav-logo />
            <div class="hidden items-center gap-1 sm:flex">
                <!-- Suggest a new package -->
                <a
                    href="https://github.com/HassanZahirnia/laravel-package-ocean"
                    target="_blank"
                    class="mr-1 select-none rounded-xl px-3.5 py-2.5
                    text-sm font-medium text-[#2E3140] ring-1
                    ring-[#C3C6D5] transition
                    duration-300 hover:bg-slate-800/5
                    hover:text-slate-900 dark:text-[#ABB0DD]
                    dark:ring-[#627288]/40 dark:hover:bg-[#110E26]/40
                    "
                    >
                    Suggest a new package
                </a>
                <!-- Github link -->
                <a
                    class="select-none p-2
                    transition duration-300 hover:text-slate-600 dark:text-[#ABB0DD]
                    dark:hover:text-[#bcc1ef]
                    "
                    href="https://github.com/HassanZahirnia/laravel-package-ocean"
                    target="_blank"
                    >
                    <div class="i-carbon-logo-github text-3xl" />    
                </a>
                <!-- Theme toggle  -->
                <label
                    class="relative -top-px cursor-pointer p-2
                    transition-all duration-300 hover:-rotate-12
                    "
                    >
                    <input
                        v-model="themeCheckbox"
                        class="toggle z-[1] cursor-pointer
                        select-none appearance-none border-none bg-transparent
                        "
                        type="checkbox"
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
    color: #ffaa00;
    box-shadow: inset 0 0 0 var(--size), calc(var(--offset-orthogonal) * -1) 0 0 var(--ray-size), var(--offset-orthogonal) 0 0 var(--ray-size), 0 calc(var(--offset-orthogonal) * -1) 0 var(--ray-size), 0 var(--offset-orthogonal) 0 var(--ray-size), calc(var(--offset-diagonal) * -1) calc(var(--offset-diagonal) * -1) 0 var(--ray-size), var(--offset-diagonal) var(--offset-diagonal) 0 var(--ray-size), calc(var(--offset-diagonal) * -1) var(--offset-diagonal) 0 var(--ray-size), var(--offset-diagonal) calc(var(--offset-diagonal) * -1) 0 var(--ray-size);
}
</style>