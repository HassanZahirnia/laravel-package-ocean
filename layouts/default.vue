<script setup lang="ts">
import '@/assets/css/tailwind.css'
import '@fontsource/poppins/latin.css'
</script>

<template>
    <section
        class="bg-[#FAFCFF] font-poppins antialiased transition
        duration-300
        overflow-clip dark:bg-[#04041F]
        dark:text-[#EAEFFB]"
        >
        <nav-bar />
        <slot />
        <footer class="mt-40">
            <div class="py-20 text-center sm:py-10">
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