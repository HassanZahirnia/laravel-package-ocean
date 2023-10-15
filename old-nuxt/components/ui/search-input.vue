<script setup lang="ts">
const route = useRoute()
const search = useSearch()

search.value = route.query.search?.toString() ?? ''
</script>

<template>
    <div
        class="group rounded-xl relative overflow-hidden
        transition-all duration-500 ease-out
        delay-100
        w-full md:max-w-[13rem]
        lg:hover:w-60 lg:focus-within:w-60
        "
        :class="{
            'lg:w-11': !search,
            'lg:w-60': search,
        }"
        >
        <!-- X icon -->
        <transition
            enter-active-class="duration-150 ease-out"
            enter-from-class="translate-x-2 rotate-90 opacity-0"
            enter-to-class="translate-x-0 rotate-0 opacity-100"
            leave-active-class="duration-150 ease-in"
            leave-from-class="translate-x-0 rotate-0 opacity-100"
            leave-to-class="translate-x-2 rotate-90 opacity-0"
            >
            <div
                v-if="search"
                class="cursor-pointer
                p-2.5
                absolute
                top-0.5 right-1.5
                "
                >
                <div
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
        <!-- Magnify icon -->
        <div
            class="i-ph-magnifying-glass-bold
            transition duration-300
            absolute
            top-[0.75rem] left-3
            text-xl
            text-[#9095AE]
            dark:text-[#ABB0DD]
            "
            />
        <!-- Search input -->
        <input
            v-model="search"
            type="text"
            class="w-full
            border-none
            py-3 px-10
            leading-5
            sm:text-sm
            transition
            duration-300
            bg-white/50
            dark:bg-[#362B59]/20
            dark:hover:bg-[#362B59]/30
            lg:placeholder:opacity-0
            lg:placeholder:transition
            lg:placeholder:duration-300
            lg:group-hover:placeholder:opacity-100
            lg:group-focus-within:placeholder:opacity-100
            placeholder:text-[#9095AE]
            dark:placeholder:text-[#ABB0DD]
            dark:ring-1 dark:ring-transparent
            dark:focus:ring-indigo-500
            shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)]
            "
            :class="{
                '': !search,
            }"
            placeholder="Search ..."
            />
    </div>
</template>