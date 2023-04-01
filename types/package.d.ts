import { categories } from '@/database/categories'

export type Category = typeof categories[number]
export type CategoryWithPackagesCount = {
    name: Category
    packagesCount: number
}

export type Package = {
    // Name of the package. Example: 'Laravel Backup'
    name: string
    
    // Description of the package. Example: 'A package to backup your Laravel app.'
    description: string

    // Category of the package. Example: 'Dev Ops'
    category: Category

    // Github URL of the package.'
    github: string

    // Composer package
    composer: string | null

    // Npm package
    npm: string | null

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

    // Laravel compatible versions, automatically detected from packagist.
    detected_compatible_versions: string[]

    // Manually set compatible versions,
    // only should be used when the package is not on packagist, or it's a php only or npm package.
    // If this is set, the `detected_compatible_versions` will be ignored.
    compatible_versions: string[]

    // Date when the package was updated in the database. Example: '2023-03-29T02:57:36+00:00'
    updated_at: string
}

export type PackageSortFields = 'first_release_at' | 'latest_release_at' | 'stars'