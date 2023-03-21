// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    routeRules: {
        '/': {
            sitemap: {
                changefreq:
                'monthly',
                priority: 1,
                lastmod: new Date().toISOString(),
            },
        },
    },
    modules: [
        'nuxt-simple-sitemap',
    ],
    typescript: {
        shim: false,
    },
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
        },
    },
})
