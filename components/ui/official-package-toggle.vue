<script setup lang="ts">
defineProps<{
    isActive: '0' | '1' | ''
}>()

const $emit = defineEmits<{
    (e: 'toggle'): void
}>()
</script>

<template>
    <div class="flex-1 flex justify-start min-[920px]:justify-end w-40">
        <div
            class="relative rounded-xl cursor-pointer group select-none
                        transition-all duration-300 ease-out
                        delay-100
                        overflow-hidden
                        w-[12.5rem] sm:w-40 lg:w-11 h-11
                        flex gap-2 items-center
                        lg:hover:w-40
                        "
            :class="{
                'bg-white/50 dark:bg-[#362B59]/30 dark:hover:bg-[#362B59]/40': isActive !== '1',
                'lg:w-40 bg-white hover:bg-white/80 dark:bg-indigo-500/20 dark:hover:bg-indigo-500/10': isActive === '1',
            }"
            @click="$emit('toggle')"
            >
            <div
                class="i-fluent-emoji-crown text-2xl
                            shrink-0
                            mb-1 ml-2.5
                            "
                />
            <div
                class="truncate
                            leading-5
                            sm:text-xs
                            transition duration-300
                            delay-100
                            lg:opacity-0
                            lg:group-hover:opacity-100
                            "
                :class="{
                    'lg:opacity-100': isActive === '1',
                }"
                >
                Official Packages
            </div>
        </div>
    </div>
</template>