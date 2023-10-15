import { categories } from '@/database/categories'
import type { Category } from '@/types/category'

export type Package = {
    // Type of the package. Example: 'laravel-package'
    package_type: PackageType

    // Name of the package. Example: 'Laravel Backup'
    name: string
    
    // Description of the package. Example: 'A package to backup your Laravel app.'
    description: string

    // Category of the package. Example: 'Dev Ops'
    category: Category

    // Github URL of the package.'
    github: string

    // Author of the package.
    // The author should usually be the name of the composer package owner,
    // Example: spatie/laravel-data -> spatie
    // In some cases where there is no composer package, and it's a npm package,
    // you can use their github username in lowercase, or something they're famous for.
    // Example: https://github.com/xiCO2k/laravel-vue-i18n which is a npm (laravel-vue-i18n)
    // package the author becomes -> xico2k
    author: string

    // Composer package
    composer: string | null

    // Npm package
    npm: string | null

    // Number of stars on Github. Example: 5194
    stars: number

    // Keywords of the package. Example: ['backup']
    keywords: string[]

    // Date of the first release on packagist. Example: '2015-09-15T15:36:13+00:00'
    first_release_at: string

    // Date of the latest release on packagist. Example: '2023-03-22T02:57:36+00:00'
    latest_release_at: string

    // Laravel compatible versions, automatically detected from packagist.
    // You can manually set this if the compatibility is not detected correctly.
    laravel_dependency_versions: string[]

    // Integrates with a paid service.
    paid_integration: boolean

    // Date when the package was updated in the database. Example: '2023-03-29T02:57:36+00:00'
    updated_at: string | null

    // Date when the package was created in the database. Example: '2023-03-29T02:57:36+00:00'
    created_at: string | null
}

export type PackageSortFields = 'first_release_at' | 'latest_release_at' | 'stars' | 'created_at'

export type PackageType =
    'laravel-package'
    | 'php-package'
    | 'npm-package'
    | 'mac-app'
    | 'windows-app'
    | 'all-operating-systems-app'
    | 'ide-extension'