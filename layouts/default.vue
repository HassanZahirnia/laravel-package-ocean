<script setup lang="ts">
import '@/assets/css/tailwind.css'
import '@fontsource/poppins/latin.css'
</script>

<template>
    <section
        class="max-h-[100vh] min-h-screen overflow-x-hidden bg-[#FAFCFF] font-poppins
        antialiased transition-all duration-300
        dark:bg-[#04041F] dark:text-[#EAEFFB]
        "
        >
        <nav-bar />
        <slot />
        <footer class="mt-40">
            <div class="pt-20 pb-10 text-center">
                <div class="text-sm text-[#545D82]">
                    Made with ❤️ by
                    <a href="https://zahirnia.com">
                        Hassan Zahirnia
                    </a>
                </div>
            </div>
        </footer>
    </section>
</template>