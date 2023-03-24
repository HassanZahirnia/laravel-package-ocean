import { autoAnimatePlugin } from '@formkit/auto-animate/vue'

export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.use(autoAnimatePlugin)
})
