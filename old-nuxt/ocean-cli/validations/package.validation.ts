import { z } from 'zod'
import semver from 'semver'
import { categories } from '../../database/categories'
import { packageTypes } from '../../database/packages'

// First Release At
export const first_release_at = z.coerce
    .date()

// Latest Release At
export const latest_release_at = z.coerce
    .date()

// Detected Compatible Versions
export const laravel_dependency_versions = z
    .array(z
        .string()
        .refine((value) => {
            if (value)
                return semver.validRange(value) !== null

            return true
        }, {
            message: 'Must be a valid semver version',
        })
        .refine((value) => {
            if (value)
                return value !== '*'

            return true
        }
        , {
            message: 'Must not be a wildcard (*)',
        }),
    )
    .refine(items => new Set(items.map(item => item)).size === items?.length, {
        message: 'Must be an array of unique strings',
    })

// Paid Integration
export const paid_integration = z
    .boolean()

// Created At
export const created_at = z.coerce
    .date()

// Updated At
export const updated_at = z.coerce
    .date()

// Laravel Package
export const laravelPackageSchema = z.object({
    package_type,
    name,
    description,
    category,
    github,
    author,
    composer,
    npm,
    stars,
    keywords,
    first_release_at,
    latest_release_at,
    laravel_dependency_versions,
    paid_integration,
    created_at,
    updated_at,
})
    .refine(
        (item) => {
            const keywords = item.keywords
            const name = item.name
            const description = item.description
            return keywords.every(keyword => !name.includes(keyword) && !description.includes(keyword))
        },
        {
            message: 'Keywords must not be used in name and description',
        },
    )
    .refine(
        (item) => {
            const package_type = item.package_type
            const composer = item.composer
            return package_type !== 'npm-package' || composer === null
        },
        {
            message: 'If package_type is "npm-package", then composer must be null',
        },
    )
    .refine(
        (item) => {
            const package_type = item.package_type
            const npm = item.npm
            return package_type !== 'php-package' && package_type !== 'laravel-package' || npm === null
        },
        {
            message: 'If package_type is "php-package" or "laravel-package", then npm must be null',
        },
    )
    .refine(
        (item) => {
            const package_type = item.package_type
            const npm = item.npm
            return npm === null || package_type === 'npm-package'
        },
        {
            message: 'If npm is not null, then package_type must be "npm-package"',
        },
    )
    .refine(
        (item) => {
            const package_type = item.package_type
            const composer = item.composer
            return composer === null || package_type === 'php-package' || package_type === 'laravel-package'
        },
        {
            message: 'If composer is not null, then package_type must be "php-package" or "laravel-package"',
        },
    )