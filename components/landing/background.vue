<template>
    <!-- Ellipse arc -->
    <div
        class="pointer-events-none absolute top-[-70vw] left-1/2
        -z-10 h-[calc(100vw+10rem)] w-[calc(100vw+10rem)] -translate-x-1/2
        scale-y-75
        scale-x-150
        select-none rounded-full
        bg-white/20 transition
        duration-300 dark:bg-[#173563]/10
        min-[2000px]:top-[-80vw]
        "
        />
    <!-- Purple blur -->
    <div
        class="pointer-events-none absolute top-[-5vw]
        right-[calc(10rem-10vw)] -z-20 h-[calc(10rem+25vw)] w-[calc(10rem+25vw)]
        select-none rounded-full bg-[#e2c9fc] blur-[calc(5rem+13vw)]
        transition duration-300
        dark:bg-[#63388E]
        "
        />
    <!-- Blue blur -->
    <div
        class="pointer-events-none absolute bottom-[-20vw]
        left-[calc(10rem-10vw)] -z-30 h-[calc(10rem+25vw)] w-[calc(10rem+25vw)]
        select-none rounded-full bg-[#60A9FF]/50 blur-[calc(5rem+13vw)]
        transition duration-300
        dark:bg-[#0A7BFF]/30
        "
        />
</template>