/** @type import('tailwindcss').Config */
module.exports = {
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
                poppins: '\'poppins\'',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
