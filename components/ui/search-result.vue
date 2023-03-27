<script setup lang="ts">
const search = useSearch()

const isHovering = ref(false)
</script>

<template>
    <div class="grid place-items-center pt-8">
        <!-- Emote faces -->
        <div class="grid h-28 w-28">
            <img
                src="@/assets/images/emotes/sad.webp"
                width="auto"
                height="auto"
                alt=""
                class="pointer-events-none w-24 select-none
                self-center justify-self-center transition
                duration-300 [grid-area:1/-1]
                "
                :class="{
                    'opacity-0': isHovering,
                }"
                />
            <img
                src="@/assets/images/emotes/excited.webp"
                width="auto"
                height="auto"
                alt=""
                class="pointer-events-none w-24 select-none
                self-center justify-self-center transition
                duration-300 [grid-area:1/-1]
                "
                :class="{
                    'opacity-0': !isHovering,
                }"
                />
        </div>
        <div class="pt-2 text-2xl font-semibold">
            Oops!
        </div>
        <div class="pt-1 font-medium">
            No packages found for
            <span
                class="cursor-pointer font-semibold text-cyan-500 underline transition duration-300
                hover:line-through
                "
                @click="search = ''"
                >{{ search }}</span>
        </div>
        <div class="pt-2 text-sm text-[#6A7789] dark:text-[#96A5BB]">
            If you know a package that is not listed here,
            feel free to suggest it.
        </div>
        <!-- Suggest a new package -->
        <div class="mt-6">
            <a
                href="https://github.com/HassanZahirnia/laravel-package-ocean"
                target="_blank"
                class="mr-1 select-none rounded-xl bg-white/50 px-5
                py-3 text-sm font-medium text-[#404a6b]
                shadow-lg shadow-slate-200/70 ring-1 ring-slate-200/20
                backdrop-blur-xl
                transition duration-300
                hover:bg-white hover:text-slate-900 hover:shadow-xl
                hover:shadow-slate-200
                dark:bg-transparent dark:text-[#ABB0DD] dark:shadow-none
                dark:ring-[#627288]/40 dark:hover:bg-[#110E26]/40
                "
                @mouseenter="isHovering = true"
                @mouseleave="isHovering = false"
                >
                Suggest a new package
            </a>
        </div>
    </div>
</template>