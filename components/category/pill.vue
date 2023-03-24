<script setup lang="ts">
import type { LaravelPackageCategory } from '@/types/laravel-package'

const $props = defineProps<{
    category: LaravelPackageCategory
}>()
</script>

<template>
    <div
        class="rounded-full px-3.5 py-1 text-xs font-semibold
        "
        :class="{
            'bg-[#F5E6FE] text-[#BD62F7] dark:bg-[#D48CFF]/20': category === 'File Management',
            'bg-[#E4F8FA] text-[#4CC8D5] dark:bg-[#3DEDFF]/20': category === 'Roles & Permissions',
            'bg-[#FBE8EF] text-[#FD5261] dark:bg-[#FF70A5]/20': category === 'Validation',
        }"
        >
        {{ category }}
    </div>
</template>