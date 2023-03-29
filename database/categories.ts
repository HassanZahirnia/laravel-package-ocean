import type { Category } from '@/types/package'
import type { selectboxItem } from '@/types/selectbox'

export const categories = [
    'File Management',
    'Auth & Permissions',
    'Database & Eloquent',
    'Debugging & Dev Tools',
    'Dev Ops',
    'Localization',
    'API',
    'SEO',
    'Testing',
    'Payment',
    'Security',
    'Mail',
    'E-Commerce',
    'CMS & Admin Panels',
    'Code Architecture',
    'Notifications',
    'UI & Blade Components',
    'Utilities & Helpers',
] as const

export const categoriesForSelectbox = categories.map((category: Category): selectboxItem<string> => {
    return {
        name: category,
        value: category,
    }
})