<script setup lang="ts">
import { gsap } from 'gsap'
import type { CategoryWithPackagesCount } from '@/types/category'

const selectedCategory = useSelectedCategory()

defineProps<{
    category: CategoryWithPackagesCount
}>()

// The state of hovering
const isHovering = ref(false)

// The DOM node to animate
const item = ref<HTMLElement | null>(null)

// The GSAP timeline
let timeline: gsap.core.Timeline | null = null

onMounted(() => {
    timeline = gsap.timeline({
        paused: true,
        onComplete: () => {
            // If not hovering, reverse the animation
            if(!isHovering.value)
                timeline?.reverse()
        },
    })
        .to(item.value, {
            x: 10,
            ease: 'sine.out',
            duration: 0.2,
        })
})

watch(
    isHovering,
    (value) => {
        // If hovering, play the animation
        if (value) timeline?.play()
        // If not hovering and animation is done, reverse it
        else if(timeline?.progress() === 1)
            timeline?.reverse()
    })
</script>

<template>
    <div
        ref="item"
        class="relative cursor-pointer
        py-2.5
        flex items-center gap-3
        "
        @mouseenter="isHovering = true"
        @mouseleave="isHovering = false"
        >
        <div
            class="h-8 w-8 rounded-lg
            grid place-items-center
            transition duration-300
            "
            :class="{
                'bg-slate-300/50 text-slate-500 dark:bg-slate-800/50': selectedCategory !== category.name,
                
                'bg-fuchsia-100 text-fuchsia-500 dark:bg-fuchsia-400/20': category.name === 'File Management' && selectedCategory === 'File Management',
                'bg-cyan-100 text-cyan-500 dark:bg-cyan-400/20': category.name === 'Auth & Permissions' && selectedCategory === 'Auth & Permissions',
                'bg-rose-100 text-rose-500 dark:bg-rose-400/20': category.name === 'Database & Eloquent' && selectedCategory === 'Database & Eloquent',
                'bg-blue-100/70 text-blue-500 dark:bg-blue-500/20': category.name === 'Debugging & Dev Tools' && selectedCategory === 'Debugging & Dev Tools',
                'bg-purple-100 text-purple-500 dark:bg-purple-500/20': category.name === 'Dev Ops' && selectedCategory === 'Dev Ops',
                'bg-lime-100 text-lime-500 dark:bg-lime-400/20': category.name === 'Localization' && selectedCategory === 'Localization',
                'bg-orange-200/70 text-orange-500 dark:bg-orange-500/20 dark:text-orange-400': category.name === 'API' && selectedCategory === 'API',
                'bg-teal-100 text-teal-500 dark:bg-teal-500/20': category.name === 'SEO' && selectedCategory === 'SEO',
                'bg-amber-100 text-amber-600 dark:bg-yellow-400/20': category.name === 'Testing' && selectedCategory === 'Testing',
                'bg-pink-100 text-pink-500 dark:bg-pink-500/20': category.name === 'Payment' && selectedCategory === 'Payment',
                'bg-indigo-100 text-indigo-500 dark:bg-indigo-500/20': category.name === 'Security' && selectedCategory === 'Security',
                'bg-green-100 text-green-500 dark:bg-[#4EAC5C]/20': category.name === 'Mail' && selectedCategory === 'Mail',
                'bg-emerald-100 text-emerald-500 dark:bg-emerald-500/20': category.name === 'E-Commerce' && selectedCategory === 'E-Commerce',
                'bg-red-100 text-red-500 dark:bg-red-500/20': category.name === 'CMS & Admin Panels' && selectedCategory === 'CMS & Admin Panels',
                'bg-sky-100 text-sky-500 dark:bg-sky-500/20': category.name === 'Code Architecture' && selectedCategory === 'Code Architecture',
                'bg-[#CBEAFE] text-[#3182CE] dark:bg-[#55a4ff]/20': category.name === 'Notifications' && selectedCategory === 'Notifications',
                'bg-violet-100 text-violet-500 dark:bg-violet-500/20': category.name === 'UI & Blade Components' && selectedCategory === 'UI & Blade Components',
                'bg-zinc-200/50 text-zinc-500 dark:bg-zinc-500/20 dark:text-zinc-400': category.name === 'Utilities & Helpers' && selectedCategory === 'Utilities & Helpers',
            }"
            >
            <!-- Category Icons -->
            <div
                v-if="category.name === 'File Management'"
                class="i-ph-files-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Auth & Permissions'"
                class="i-ph-users-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Database & Eloquent'"
                class="i-ph-database-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Debugging & Dev Tools'"
                class="i-ph-bug-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Dev Ops'"
                class="i-ph-desktop-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Localization'"
                class="i-ph-globe-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'API'"
                class="i-ph-cloud-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'SEO'"
                class="i-ph-magnifying-glass-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Testing'"
                class="i-ph-seal-check-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Payment'"
                class="i-ph-credit-card-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Security'"
                class="i-ph-shield-check-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Mail'"
                class="i-ph-envelope-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'E-Commerce'"
                class="i-ph-shopping-bag-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'CMS & Admin Panels'"
                class="i-ph-browsers-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Code Architecture'"
                class="i-ph-code-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Notifications'"
                class="i-ph-bell-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'UI & Blade Components'"
                class="i-ph-file-dashed-duotone text-xl"
                />
            <div
                v-else-if="category.name === 'Utilities & Helpers'"
                class="i-ph-wrench-duotone text-xl"
                />
        </div>
        <!-- Category name and package count -->
        <div class="">
            <div
                class="text-sm
                font-medium
                dark:text-slate-300
                "
                >
                {{ category.name }}
            </div>
            <div
                class="text-xs
                text-slate-400 dark:text-slate-400
                "
                >
                {{ category.packagesCount }} Packages
            </div>
        </div>
    </div>
</template>