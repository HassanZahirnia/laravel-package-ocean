<script setup lang="ts">
import '@/assets/css/tailwind.css'
import '@fontsource/poppins/latin.css'
</script>

<template>
    <section
        class="overflow-clip antialiased min-h-screen
        selection:bg-stone-800/10 dark:selection:bg-indigo-100/10
        font-poppins
        transition duration-300
        bg-[#FAFCFF] dark:bg-[#04041F] dark:text-[#EAEFFB]
        "
        >
        <nav-bar />
        <slot />
        <footer-section />
    </section>
</template>