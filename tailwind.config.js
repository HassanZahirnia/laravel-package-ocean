/** @type {import('tailwindcss').Config} */
const { fontFamily } = require('tailwindcss/defaultTheme')

export default {
    darkMode: 'class',
    content: ['./resources/**/*.{js,blade.php}'],
    theme: {
        extend: {
            fontFamily: {
                poppins: '\'Poppins\', Verdana, sans-serif',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
