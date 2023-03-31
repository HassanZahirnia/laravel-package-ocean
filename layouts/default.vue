<script setup lang="ts">
import '@/assets/css/tailwind.css'
import '@fontsource/poppins/latin.css'
import 'tippy.js/dist/tippy.css'
import 'tippy.js/animations/shift-away.css'
</script>

<template>
    <section
        class="overflow-clip antialiased min-h-screen
        font-poppins
        transition duration-300
        bg-[#FAFCFF]
        dark:bg-[#04041F] dark:text-[#EAEFFB]
        "
        >
        <nav-bar />
        <slot />
        <footer class="mt-40">
            <div class="text-center py-20 sm:py-10">
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

<style lang="stylus">
.tippy-box[data-theme~='indigo']
    @apply bg-slate-800 rounded-full py-1 px-2 shadow-lg shadow-black/5 text-xs font-poppins;
.tippy-box[data-theme~='indigo'][data-placement^='top'] > .tippy-arrow::before
    @apply border-t-slate-800;
.tippy-box[data-theme~='indigo'][data-placement^='bottom'] > .tippy-arrow::before
    @apply border-b-slate-800;
.tippy-box[data-theme~='indigo'][data-placement^='left'] > .tippy-arrow::before
    @apply border-l-slate-800;
.tippy-box[data-theme~='indigo'][data-placement^='right'] > .tippy-arrow::before
    @apply border-r-slate-800;
</style>