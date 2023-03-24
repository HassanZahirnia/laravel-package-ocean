<script setup lang="ts">

</script>

<template>
    <div
        class="px-5 pt-20 text-[#273240]
        dark:text-[#EAEFFB]
        "
        >
        <div class="flex flex-wrap items-center justify-between gap-10">
            <div
                class="
                text-3xl
                font-bold
                "
                >
                Packages
            </div>
            <ui-search-input />
        </div>
        <div class="flex items-start gap-10 pt-10">
            <package-categories />
            <package-list />
        </div>
    </div>
</template>