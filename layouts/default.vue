<script setup lang="ts">
import '@/assets/css/tailwind.css'
import '@fontsource/poppins/latin.css'
</script>

<template>
    <section
        class="min-h-screen overflow-hidden bg-[#FAFCFF] font-poppins
        antialiased transition-all duration-300
        dark:bg-[#04041F] dark:text-[#EAEFFB]
        "
        >
        <nav-bar />
        <slot />
    </section>
</template>