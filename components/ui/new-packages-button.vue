<script setup lang="ts">
defineProps<{
    newPackagesCount: number,
    isActive: boolean
}>()

const $emit = defineEmits<{
    (e: 'toggle'): void
}>()
</script>

<template>
    <ui-tooltip
    :content="newPackagesCount + ' New packages were added since your last visit !'"
    theme="emerald"
    @click.stop.prevent="$emit('toggle')"
    >
        <div
            class="py-1.5 px-4 select-none
            rounded-full cursor-pointer
            transition-all duration-300
            flex gap-2 items-center
            font-medium
            hover:brightness-105
            "
            :class="{
                'bg-slate-300/50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-400': !isActive,
                'bg-teal-200/70 text-teal-600 dark:text-teal-500 dark:bg-teal-500/20': isActive,
            }"
            >
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400" :class="{
                    'opacity-75': !isActive,
                    'opacity-0': isActive,
                }" />
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-teal-500" />
            </span>
            <div class="">
                {{ newPackagesCount }}
                <span class="inline">New Item</span>
                <span class="inline">{{ newPackagesCount > 1 ? 's' : '' }}</span>
            </div>
        </div>
    </ui-tooltip>
</template>