// https://nuxt.com/docs/api/configuration/nuxt-config
import presetIcons from '@unocss/preset-icons'
import { FileSystemIconLoader } from '@iconify/utils/lib/loader/node-loaders'

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
    app: {
        head: {
            htmlAttrs: {
                lang: 'en-US',
            },
            title: 'Laravel Package Ocean - Discover new & useful Laravel packages',
            meta: [
                {
                    name: 'description',
                    content: 'Discover new & useful Laravel packages',
                },
                {
                    name: 'msapplication-TileColor',
                    content: '#2b5797',
                },
                {
                    name: 'theme-color',
                    content: '#ffffff',
                },
            ],
            link: [
                { rel: 'apple-touch-icon', sizes: '180x180', href: '/apple-touch-icon.png?v=w1dBNxT7Wg' },
                { rel: 'icon', type: 'image/png', sizes: '32x32', href: '/favicon-32x32.png?v=w1dBNxT7Wg' },
                { rel: 'icon', type: 'image/png', sizes: '16x16', href: '/favicon-16x16.png?v=w1dBNxT7Wg' },
                { rel: 'manifest', href: '/site.webmanifest?v=w1dBNxT7Wg' },
                { rel: 'mask-icon', href: '/safari-pinned-tab.svg?v=w1dBNxT7Wg', color: '#5bbad5' },
                { rel: 'shortcut icon', href: '/favicon.ico?v=w1dBNxT7Wg' },
            ],
        },
    },
    modules: [
        'nuxt-simple-sitemap',
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
        },
    },
})
