<script setup lang="ts">

</script>

<template>
    <footer class="mt-40 relative z-10 text-slate-600 dark:text-[#545D82]">
        <div
            class="py-20 sm:py-10
            grid place-items-center
            "
            >
            <div
                class="w-full max-w-[22rem]
                flex gap-2 items-center"
                >
                <div class="bg-current opacity-20 dark:opacity-30 h-px w-full" />
                <div class="shrink-0">
                    An open-source project, by
                </div>
            </div>
            <div
                href="https://zahirnia.com"
                class="pt-5 group
                flex gap-5 items-start justify-center
                "
                >
                <div class="shrink-0 h-14 w-14 overflow-hidden rounded-full bg-slate-800">
                    <img
                        src="@/assets/images/hassan-zahirnia.webp"
                        alt="Hassan Zahirnia"
                        class="h-full w-full object-cover
                        transition duration-300 group-hover:scale-110
                        "
                        width="auto"
                        height="auto"
                        />
                </div>
                <div class="text-left">
                    <div
                        href="https://zahirnia.com"
                        class="font-extrabold text-xl
                        bg-clip-text text-transparent
                        bg-gradient-to-r
                        from-pink-400 to-cyan-400
                        dark:from-pink-300 dark:to-cyan-300
                        transition duration-300
                        group-hover:translate-x-0.5
                        "
                        >
                        Hassan Zahirnia
                    </div>
                    <div class="pt-0.5">
                        Web designer & developer
                    </div>
                    <div
                        class="pt-3 flex flex-wrap
                        justify-start gap-5
                        "
                        >
                        <a
                            href="https://github.com/HassanZahirnia"
                            class="flex items-center
                            gap-2 transition
                            duration-300 hover:scale-110
                            hover:opacity-90
                            dark:hover:brightness-150
                            "
                            >
                            <div class="i-carbon-logo-github h-5 w-5" />
                            <div class="text-sm">
                                Github
                            </div>
                        </a>
                        <a
                            href="https://twitter.com/HassanZahirnia"
                            class="flex items-center
                            gap-2 transition
                            duration-300 hover:scale-110
                            hover:opacity-90
                            dark:hover:brightness-150
                            "
                            >
                            <div class="i-carbon-logo-twitter h-5 w-5" />
                            <div class="text-sm">
                                Twitter
                            </div>
                        </a>
                        <a
                            href="https://zahirnia.com"
                            class="flex items-center
                            gap-2 transition
                            duration-300 hover:scale-110
                            hover:opacity-90
                            dark:hover:brightness-150
                            "
                            >
                            <div class="i-carbon:earth-filled h-[1.15rem] w-[1.15rem]" />
                            <div class="text-sm">
                                Website
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-6 bg-current opacity-20 dark:opacity-30 h-px w-full max-w-[22rem]" />
            <div class="pt-20 text-sm">
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
</template>