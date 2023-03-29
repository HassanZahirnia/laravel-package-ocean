<script setup lang="ts">
const search = useSearch()

const isHovering = ref(false)
</script>

<template>
    <div
        class="pt-8
        grid place-items-center 
        "
        >
        <!-- Emote faces -->
        <div
            class="h-28 w-28
            grid
            "
            >
            <img
                src="@/assets/images/emotes/sad.webp"
                width="auto"
                height="auto"
                alt=""
                class="pointer-events-none select-none
                w-24
                transition duration-300
                [grid-area:1/-1]
                self-center justify-self-center
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
                class="pointer-events-none select-none
                w-24
                transition duration-300
                [grid-area:1/-1]
                self-center justify-self-center
                "
                :class="{
                    'opacity-0': !isHovering,
                }"
                />
        </div>
        <div class="pt-2 text-2xl font-semibold">
            Oops!
        </div>
        <div
            class="pt-1
            inline-flex items-center gap-2
            font-medium
            "
            >
            No packages found
            <span v-if="search">for</span>
            <span
                v-if="search"
                class="rounded-full cursor-pointer
                transition duration-300
                px-2 pt-px pb-0.5
                inline-flex gap-1
                items-center
                text-cyan-600
                dark:text-cyan-500
                bg-cyan-200
                hover:bg-cyan-200/50
                dark:bg-cyan-900/50
                dark:hover:bg-cyan-800
                "
                @click="search = ''"
                >
                <span class="">
                    {{ search }}
                </span>
                <span class="i-ph-x" />
            </span>
        </div>
        <div
            class="pt-2
            text-sm
            text-[#6A7789] dark:text-[#96A5BB]
            "
            >
            If you know a package that is not listed here,
            feel free to suggest it.
        </div>
        <!-- Suggest a new package -->
        <div class="mt-6">
            <a
                href="https://github.com/HassanZahirnia/laravel-package-ocean"
                target="_blank"
                class="rounded-xl select-none
                transition duration-300
                backdrop-blur-xl
                px-5 py-3
                mr-1
                text-sm
                font-medium
                text-[#404a6b]
                hover:text-slate-900
                dark:text-[#ABB0DD]
                bg-white/50
                hover:bg-white
                dark:bg-transparent
                dark:hover:bg-[#110E26]/40
                shadow-lg shadow-slate-200/70
                ring-1 ring-slate-200/20
                dark:ring-[#627288]/40
                hover:shadow-xl
                hover:shadow-slate-200
                dark:shadow-none
                "
                @mouseenter="isHovering = true"
                @mouseleave="isHovering = false"
                >
                Suggest a new package
            </a>
        </div>
    </div>
</template>