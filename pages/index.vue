<script setup lang="ts">
</script>

<template>
    <section class="relative z-10 mx-auto w-full max-w-screen-xl">
        <div
            class="pointer-events-none absolute
            top-[-70vw] right-[-15rem] -z-10
            h-[calc(100vw+10rem)]
            w-[calc(100vw+10rem)]
            scale-y-75 scale-x-150
            rounded-full bg-white/30 dark:bg-[#173563]/10
            "
            />
        <div
            class="pointer-events-none absolute -top-10 right-20 -z-20 h-[30rem]
            w-[30rem] rounded-full bg-[#E6D0FC] blur-[200px]
            transition duration-300
            dark:bg-[#63388E]
            "
            />
        <div
            class="pointer-events-none absolute -bottom-40 left-20 -z-30 h-[30rem]
            w-[30rem] rounded-full bg-[#60A9FF]/50 blur-[200px]
            transition duration-300
            dark:bg-[#0A7BFF]/30
            "
            />
        <div class="relative">
            <img
                src="@/assets/images/fluid-shape.webp"
                width="auto"
                height="auto"
                class="absolute -top-10 right-1/2 z-[-1]
                h-72 w-72 translate-x-1/2
                "
                />
            <div class="pt-36">
                <div
                    class="mx-auto w-full max-w-3xl rounded-3xl
                    bg-white/50 p-14 text-center
                    shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
                    backdrop-blur-xl
                    dark:bg-[#110E26]/50
                    "
                    >
                    <div class="text-4xl font-bold text-[#040404] dark:text-white">
                        Discover new Laravel packages.
                    </div>
                    <div
                        class="mx-auto max-w-lg pt-5 text-xl
                        font-medium text-[#6A7789]
                        dark:text-[#96A5BB]
                        "
                        >
                        Our goal is to help the Laravel community to find new & useful Laravel packages in one place.
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>