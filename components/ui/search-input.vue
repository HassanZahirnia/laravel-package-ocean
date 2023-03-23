<script setup lang="ts">

</script>

<template>
    <div class="relative w-full min-[550px]:max-w-xs">
        <div
            class="i-ph-magnifying-glass-bold
            absolute top-3.5 left-3.5 text-xl text-[#9095AE]
            transition duration-300
            dark:text-[#ABB0DD]
            "
            />
        <input
            type="text"
            class="w-full
            rounded-2xl border-none
            py-3 pl-11
            font-medium shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            transition
            duration-300
            placeholder:text-sm
            placeholder:text-[#9095AE] dark:bg-[#362B59]/20
            dark:ring-1 dark:ring-[#132447]
            dark:placeholder:text-[#ABB0DD]
            dark:focus:ring-indigo-500
            "
            placeholder="Search anything ..."
            />
    </div>
</template>