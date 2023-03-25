<script setup lang="ts">
import type { LaravelPackage } from '@/types/laravel-package'

const laravelPackages: LaravelPackage[] = [
    {
        name: 'Laravel Media Library',
        description: 'Associate files with eloquent models.',
        github: 'https://github.com/spatie/laravel-medialibrary',
        repo: 'laravel-medialibrary',
        stars: 5100,
        category: 'File Management',
    },
    {
        name: 'Laravel Permissions',
        description: 'Associate users with roles and permissions.',
        github: 'https://github.com/spatie/laravel-permission',
        repo: 'laravel-permission',
        stars: 11100,
        category: 'Roles & Permissions',
    },
    {
        name: 'Laravel Auditing',
        description: 'Understand changes in Eloquent models.',
        github: 'https://github.com/owen-it/laravel-auditing',
        repo: 'laravel-auditing',
        stars: 2600,
        category: 'Validation',
    },
]
</script>

<template>
    <div class="w-full">
        <div class="flex flex-wrap items-center justify-between gap-5">
            <div class="text-2xl font-semibold">
                Packages
            </div>
            <ui-search-input />
        </div>
        <div
            v-auto-animate
            class="grid grid-cols-[repeat(auto-fill,19rem)] items-start gap-5 pt-6"
            >
            <package-card
                v-for="laravelPackage in laravelPackages"
                :key="laravelPackage.name"
                :laravel-package="laravelPackage"
                />
        </div>
    </div>
</template>