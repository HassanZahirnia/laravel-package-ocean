<script setup>
const siteName = 'Laravel Package Ocean'
const siteTitle = 'Laravel Package Ocean - Discover new Laravel packages'
const siteDescription = 'A place where you can find any Laravel package that you may need for your next project.'
const ogImageUrl = 'https://laravel-package-ocean.com/opengraph.webp'
const twitterHandle = '@HassanZahirnia'
const siteUrl = 'https://laravel-package-ocean.com'

useServerSeoMeta({
    title: siteTitle,
    description: siteDescription,
    // Opengraph
    ogSiteName: siteName,
    ogType: 'website',
    ogTitle: siteTitle,
    ogDescription: siteDescription,
    ogImage: ogImageUrl,
    ogLocale: 'en',
    ogUrl: siteUrl,
    // Twitter
    twitterCard: 'summary_large_image',
    twitterImage: ogImageUrl,
    twitterSite: twitterHandle,
    twitterCreator: twitterHandle,
    twitterTitle: siteTitle,
    twitterDescription: siteDescription,
})
</script>

<template>
    <NuxtLayout>
        <NuxtPage />
    </NuxtLayout>
</template>
