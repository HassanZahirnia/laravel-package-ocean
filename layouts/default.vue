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
        <footer class="mt-40">
            <div
                class="text-center py-20 sm:py-10
                text-sm text-[#545D82]
                "
                >
                <div class="">
                    Made with
                    <span class="i-fluent-emoji-purple-heart text-lg inline-block relative top-1" />
                    by
                    <a
                        href="https://zahirnia.com"
                        class="
                        transition duration-300
                        hover:text-black
                        dark:hover:text-white
                        underline
                        "
                        >
                        Hassan Zahirnia
                    </a>
                </div>
                <div class="pt-10">
                    This site is powered by
                    <a
                        href="https://www.netlify.com/"
                        class="transition duration-300
                        hover:text-black
                        dark:hover:text-white
                        underline
                        "
                        >Netlify</a>
                </div>
            </div>
        </footer>
    </section>
</template>