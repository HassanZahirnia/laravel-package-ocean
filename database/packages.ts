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
        first_release_at: '2015-08-20 11:48',
        latest_release_at: '2023-03-17 11:39',
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
        first_release_at: '2015-04-22 19:07',
        latest_release_at: '2023-03-06 11:26',
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
        first_release_at: '2015-09-15 15:32',
        latest_release_at: '2023-03-22 02:57',
    },
]