// https://nuxt.com/docs/api/configuration/nuxt-config
import presetIcons from '@unocss/preset-icons'
import { FileSystemIconLoader } from '@iconify/utils/lib/loader/node-loaders'

export default defineNuxtConfig({
    routeRules: {
        '/': {
            sitemap: {
                changefreq:
                'daily',
                priority: 1,
                lastmod: new Date().toISOString(),
            },
        },
        '/api/**': { cors: true, headers: { 'access-control-allow-methods': 'GET' } },
    },
    app: {
        head: {
            htmlAttrs: {
                lang: 'en-US',
            },
            bodyAttrs: {
                class: 'bg-[#FAFCFF] dark:bg-[#04041F] dark:text-[#EAEFFB] selection:bg-stone-800/10 dark:selection:bg-indigo-100/10',
            },
            title: 'Laravel Package Ocean - Discover new & useful Laravel packages',
            meta: [
                {
                    name: 'description',
                    content: 'A place where you can find any Laravel package that you may need for your next project.',
                },
                {
                    name: 'msapplication-TileColor',
                    content: '#2b5797',
                },
                {
                    name: 'theme-color',
                    content: '#04041F',
                },
            ],
            link: [
                { rel: 'apple-touch-icon', sizes: '180x180', href: '/favicon/apple-touch-icon.png?v=tepFhZKP8' },
                { rel: 'icon', type: 'image/png', sizes: '32x32', href: '/favicon/favicon-32x32.png?v=tepFhZKP8' },
                { rel: 'icon', type: 'image/png', sizes: '16x16', href: '/favicon/favicon-16x16.png?v=tepFhZKP8' },
                { rel: 'manifest', href: '/favicon/site.webmanifest?v=tepFhZKP8' },
                { rel: 'mask-icon', href: '/favicon/safari-pinned-tab.svg?v=tepFhZKP8', color: '#5bbad5' },
                { rel: 'shortcut icon', href: '/favicon/favicon.ico?v=tepFhZKP8' },
                { rel: 'alternate', type: 'application/rss+xml', title: 'Laravel Package Ocean - Discover new Laravel packages', href: '/rss.xml' },
            ],
        },
    },
    sitemap: {
        hostname: 'https://laravel-package-ocean.com',
    },
    modules: [
        'nuxt-simple-sitemap',
        'nuxt-gtag',
        '@unocss/nuxt',
        '@vueuse/nuxt',
        '@nuxtjs/color-mode',
    ],
    unocss: {
        uno: false,
        icons: true,
        preflight: false,
        attributify: false,
        shortcuts: [],
        rules: [],
        presets: [
            presetIcons({
                collections: {
                    svg: FileSystemIconLoader(
                        './assets/icons',
                    ),
                },
            }),
        ],
    },
    sourcemap: {
        server: true,
        client: false,
    },
    colorMode: {
        classSuffix: '',
    },
    typescript: {
        shim: false,
    },
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
            // Temporary fix for the node-glob bug that fails the Netlify build on the fontsource/poppins upgrade to v5.0.0
            cssnano: process.env.NODE_ENV === 'production'
                ? { preset: ['default', { discardComments: { removeAll: true } }] }
                : false, // disable cssnano when not in production
        },
    },
})
