import type { LaravelPackage } from '@/types/laravel-package'

export const laravelPackages: LaravelPackage[] = [
    {
        name: 'Laravel Auditing',
        description: 'Understand changes in Eloquent models.',
        category: 'Validation',
        github: 'https://github.com/owen-it/laravel-auditing',
        repo: 'laravel-auditing',
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
        composer: 'spatie/laravel-permission',
        stars: 11100,
        keywords: [],
    },
]