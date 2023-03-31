<script setup lang="ts">
import { laravelPackages } from '@/database/packages'
import { categories } from '@/database/categories'
import type { Category, CategoryWithPackagesCount } from '@/types/package'

const categoriesWithPackagesCount = categories.map((category: Category): CategoryWithPackagesCount => {
    return {
        name: category,
        packagesCount: laravelPackages.filter(laravelPackage => laravelPackage.category === category).length,
    }
})

const selectedCategory = useSelectedCategory()
</script>

<template>
    <div
        class="hidden sm:block
        w-full max-w-[15rem] sm:pb-20
        "
        >
        <div class="min-h-[3rem] flex items-center">
            <div
                class="text-2xl
                font-semibold
                transition duration-300
                "
                >
                Categories
            </div>
        </div>
        <div class="w-full pt-4">
            <category-item
                v-for="category in categoriesWithPackagesCount"
                :key="category.name"
                :category="category"
                @click="selectedCategory = category.name"
                />
        </div>
    </div>
</template>