import type { Category, CategoryWithPackagesCount } from '@/types/category'

import { laravelPackages } from '@/database/packages'

export const categories: Category[] = [
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
]

// Categories with packages count
export const categoriesWithPackagesCount = categories.map((category: Category): CategoryWithPackagesCount => {
    const packagesCount = laravelPackages.filter(laravelPackage => laravelPackage.category === category).length

    return {
        name: category,
        packagesCount,
    }
})