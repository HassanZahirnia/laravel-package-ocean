<script setup lang="ts">
import '@/assets/css/tailwind.css'
import '@fontsource/poppins/latin.css'
</script>

<template>
    <section
        class="min-h-screen bg-[#FAFCFF] font-poppins
        antialiased dark:bg-slate-800 dark:text-slate-500
        "
        >
        <slot />
    </section>
</template>