<script setup lang="ts">
const route = useRoute()
const router = useRouter()
const search = useSearch()
search.value = route.query.search?.toString() ?? ''

watch(search, (value) => {
    router.push({
        path: '/',
        query: { search: value },
    })
})
</script>

<template>
    <div class="relative w-full min-[550px]:max-w-xs">
        <transition
            enter-active-class="duration-150 ease-out"
            enter-from-class="translate-x-1 rotate-45 opacity-0"
            enter-to-class="translate-x-0 rotate-0 opacity-100"
            leave-active-class="duration-150 ease-in"
            leave-from-class="translate-x-0 rotate-0 opacity-100"
            leave-to-class="translate-x-1 rotate-45 opacity-0"
            >
            <div
                class="absolute top-1 right-1.5
                cursor-pointer p-2.5
                "
                >
                <div
                    v-if="search"
                    class="i-ph-x text-xl text-[#9095AE]
                    transition duration-300
                    hover:scale-110
                    hover:text-black
                    dark:text-[#ABB0DD]
                    dark:hover:text-white
                    "
                    @click="search = ''"
                    />
            </div>
        </transition>
        <div
            class="i-ph-magnifying-glass-bold
            absolute top-3.5 left-3.5 text-xl text-[#9095AE]
            transition duration-300
            dark:text-[#ABB0DD]
            "
            />
        <input
            v-model="search"
            type="text"
            class="w-full
            rounded-2xl border-none
            py-3 px-11
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