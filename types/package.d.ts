import { categories } from '@/database/categories'

export type Category = typeof categories[number]

export type Package = {
    // Name of the package. Example: 'Laravel Backup'
    name: string
    
    // Description of the package. Example: 'A package to backup your Laravel app.'
    description: string

    // Category of the package. Example: 'Dev Ops'
    category: Category

    // Github URL of the package.'
    github: string

    // Composer name of the package. Example: 'spatie/laravel-backup'
    composer: string

    // Author of the package. Example: 'spatie'
    author: string

    // Number of stars on Github. Example: 5194
    stars: number

    // Keywords of the package. Example: ['backup']
    keywords: string[]

    // Date of the first release on packagist. Example: '2015-09-15T15:36:13+00:00'
    first_release_at: string

    // Date of the latest release on packagist. Example: '2023-03-22T02:57:36+00:00'
    latest_release_at: string

    // Date when the package was updated in the database. Example: '2023-03-29T02:57:36+00:00'
    updated_at: string
}

export type PackageSortFields = 'first_release_at' | 'latest_release_at' | 'stars'