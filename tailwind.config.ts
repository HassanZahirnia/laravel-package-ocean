import type { Config } from 'tailwindcss'

export default {
    darkMode: 'class',
    content: [
        './components/**/*.{js,vue,ts}',
        './layouts/**/*.{js,vue,ts}',
        './pages/**/*.{js,vue,ts}',
        './plugins/**/*.{js,vue,ts}',
        './app.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                poppins: '\'poppins\', Verdana, sans-serif',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
} satisfies Config

