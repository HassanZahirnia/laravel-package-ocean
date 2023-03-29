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
    <label
        class="gsap-theme-toggle
        cursor-pointer
        p-2
        relative
        -top-px
        sm:scale-0
        "
        @mouseenter="themeIsHovering = true"
        @mouseleave="themeIsHovering = false"
        >
        <input
            v-model="themeCheckbox"
            class="toggle
            z-[1]
            cursor-pointer
            select-none
            appearance-none
            border-none
            bg-transparent
            "
            type="checkbox"
            aria-label="Theme toggle"
            />
    </label>
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