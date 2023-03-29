<script setup lang="ts">
import type { Category } from '@/types/package'

defineProps<{
    category: Category
}>()
</script>

<template>
    <div
        class="px-3.5 py-1 rounded-full
        text-xs font-semibold
        transition duration-300
        hover:opacity-80
        "
        :class="{
            'bg-fuchsia-100 text-fuchsia-500 dark:bg-fuchsia-400/20': category === 'File Management',
            'bg-cyan-100 text-cyan-500 dark:bg-cyan-400/20': category === 'Auth & Permissions',
            'bg-rose-100 text-rose-500 dark:bg-rose-400/20': category === 'Database & Eloquent',
            'bg-blue-100/70 text-blue-500 dark:bg-blue-500/20': category === 'Debugging & Dev Tools',
            'bg-purple-100 text-purple-500 dark:bg-purple-500/20': category === 'Dev Ops',
            'bg-lime-100 text-lime-500 dark:bg-lime-400/20': category === 'Localization',
            'bg-orange-200/70 text-orange-500 dark:bg-orange-500/20 dark:text-orange-400': category === 'API',
            'bg-teal-100 text-teal-500 dark:bg-teal-500/20': category === 'SEO',
            'bg-amber-100 text-amber-600 dark:bg-yellow-400/20': category === 'Testing',
            'bg-pink-100 text-pink-500 dark:bg-pink-500/20': category === 'Payment',
            'bg-indigo-100 text-indigo-500 dark:bg-indigo-500/20': category === 'Security',
            'bg-green-100 text-green-500 dark:bg-[#4EAC5C]/20': category === 'Mail',
            'bg-emerald-100 text-emerald-500 dark:bg-emerald-500/20': category === 'E-Commerce',
            'bg-red-100 text-red-500 dark:bg-red-500/20': category === 'CMS & Admin Panels',
            'bg-sky-100 text-sky-500 dark:bg-sky-500/20': category === 'Code Architecture',
            'bg-[#CBEAFE] text-[#3182CE] dark:bg-[#55a4ff]/20': category === 'Notifications',
            'bg-violet-100 text-violet-500 dark:bg-violet-500/20': category === 'UI & Blade Components',
            'bg-zinc-200/50 text-zinc-500 dark:bg-zinc-500/20 dark:text-zinc-400': category === 'Utilities & Helpers',
        }"
        >
        {{ category }}
    </div>
</template>