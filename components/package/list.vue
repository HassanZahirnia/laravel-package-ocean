<script setup lang="ts">
import { laravelPackages } from '@/database/packages'
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