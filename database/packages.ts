import type { Package } from '@/types/package'

// Note that the `composer` property is used as the unique identifier for each package.

export const laravelPackages: Package[] = [
    {
        name: 'Laravel Auditing',
        description: 'Understand changes in Eloquent models.',
        category: 'Validation',
        github: 'https://github.com/owen-it/laravel-auditing',
        repo: 'laravel-auditing',
        author: 'owen-it',
        composer: 'owen-it/laravel-auditing',
        stars: 2600,
        keywords: [],
    },
    {
        name: 'Laravel Media Library',
        description: 'Associate files with eloquent models.',
        category: 'File Management',
        github: 'https://github.com/spatie/laravel-medialibrary',
        repo: 'laravel-medialibrary',
        author: 'spatie',
        composer: 'spatie/laravel-medialibrary',
        stars: 5100,
        keywords: [],
    },
    {
        name: 'Laravel Permissions',
        description: 'Associate users with roles and permissions.',
        category: 'Roles & Permissions',
        github: 'https://github.com/spatie/laravel-permission',
        repo: 'laravel-permission',
        author: 'spatie',
        composer: 'spatie/laravel-permission',
        stars: 11100,
        keywords: [],
    },
]