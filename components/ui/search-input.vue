<script setup lang="ts">
const route = useRoute()
const search = useSearch()

search.value = route.query.search?.toString() ?? ''
</script>

<template>
    <div
        class="relative
        w-full
        min-w-[13rem] min-[800px]:max-w-[16rem]
        "
        >
        <transition
            enter-active-class="duration-150 ease-out"
            enter-from-class="translate-x-1 rotate-45 opacity-0"
            enter-to-class="translate-x-0 rotate-0 opacity-100"
            leave-active-class="duration-150 ease-in"
            leave-from-class="translate-x-0 rotate-0 opacity-100"
            leave-to-class="translate-x-1 rotate-45 opacity-0"
            >
            <div
                class="cursor-pointer
                p-2.5
                absolute
                top-1 right-1.5
                "
                >
                <div
                    v-if="search"
                    class="i-ph-x
                    transition duration-300
                    text-xl
                    text-[#9095AE]
                    hover:text-black
                    dark:text-[#ABB0DD]
                    dark:hover:text-white
                    hover:scale-110
                    "
                    @click="search = ''"
                    />
            </div>
        </transition>
        <div
            class="i-ph-magnifying-glass-bold
            transition duration-300
            absolute
            top-3.5 left-3.5
            text-xl
            text-[#9095AE]
            dark:text-[#ABB0DD]
            "
            />
        <input
            v-model="search"
            type="text"
            class="w-full
            rounded-xl border-none
            py-3 px-11
            text-sm font-medium
            transition
            duration-300
            dark:bg-[#362B59]/20
            placeholder:text-[#9095AE]
            dark:placeholder:text-[#ABB0DD]
            dark:ring-1 dark:ring-[#132447]
            dark:focus:ring-indigo-500
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            "
            placeholder="Search anything ..."
            />
    </div>
</template>