import { z } from 'zod'
import semver from 'semver'
import { categories } from '~/database/categories'

// Name
export const name = z
    .string()
    .min(2)
    .max(40)
    .regex(/^(?!.*[\-\+\(\)&]{2})[0-9a-zA-Z\-\+\(\)&]+(\s[0-9a-zA-Z\-\+\(\)&]+)*$/, {
        message: 'Must contain only letters, numbers, spaces, and the following characters: - + ( ) &',
    })
    .refine(
        name => !/\s{2,}/.test(name),
        {
            message: 'Must not contain multiple spaces between words',
        },
    )
    .refine(
        (name) => {
            // Each word in the name should be capitalized except
            // when the word starts with i18 or,
            // a single lower case letter followed by a upper case letter
            const words = name.split(' ')
            const capitalizedWords = words.map((word) => {
                if (word.startsWith('i18'))
                    return word
                if (/^[a-z][A-Z]/.test(word))
                    return word
                return word.charAt(0).toUpperCase() + word.slice(1)
            })
            return capitalizedWords.join(' ') === name
        },
        {
            message: 'Each word should be capitalized',
        },
    )

// Description
export const description = z
    .string()
    .min(5)
    .max(100)
    .endsWith('.')
    .refine(
        (description) => {
            const firstLetter = description.charAt(0)
            return firstLetter === firstLetter.toUpperCase()
        },
        {
            message: 'Must start with a capitalized letter',
        },
    )
    .refine(
        (description) => {
            const firstLetter = description.charAt(0)
            return /[a-zA-Z]/.test(firstLetter)
        },
        {
            message: 'Must start with a letter',
        },
    )
    .refine(
        (description) => {
            return !/\s{2,}/.test(description)
        },
        {
            message: 'Must not contain multiple spaces between words',
        },
    )
    .refine(
        (description) => {
            const specialCharRegex = /[\"\\\b\f\n\r\t]/g
            return !specialCharRegex.test(description)
        },
        {
            message: 'Must not contain characters that need to be escaped in JSON strings',
        },
    )

// Category
export const category = z
    .enum(categories as [string, ...string[]])

// Github
export const github = z
    .string()
    .url()
    .min(19)
    .startsWith('https://github.com/')
    .regex(/^https:\/\/github\.com\/[a-zA-Z0-9\-_]+\/[a-zA-Z0-9\-_.]+$/i, {
        message: 'Must be a valid Github URL',
    })

// Author
export const author = z
    .string()
    .min(2)
    .regex(/^[a-zA-Z0-9\-]+$/, {
        message: 'Must contain only letters, numbers, and the following characters: -',
    })

// Composer
export const composer = z
    .string()
    .min(2)
    .regex(/^[a-z0-9]+(?:-[a-z0-9]+)*\/[a-z0-9]+(?:-[a-z0-9]+)*$/i, {
        message: 'Must be a valid composer package name',
    })
    .refine((value) => {
        if (value) {
            const packageName = value.split('/')[1]
            return packageName?.length >= 1 && packageName?.length <= 100
        }
        return true
    }, 'Invalid composer package name')
    .nullable()

// Npm
export const npm = z
    .string()
    .min(2)
    .regex(/^(?!-)(?!.*--)[a-zA-Z0-9_.-]+$/, {
        message: 'Must be a valid npm package name',
    })
    .nullable()

// Stars
export const stars = z
    .number()
    .nonnegative()

// Keywords
export const keywords = z
    .array(z
        .string()
        .nonempty()
        .regex(/^(?!.* {2})[a-zA-Z0-9]+([ -\/\.]?[a-zA-Z0-9]+)*$/, {
            message: 'Must be alphanumeric and single spaces and the following characters: - / .',
        }),
    )
    .refine(items => new Set(items).size === items?.length, {
        message: 'Must be an array of unique strings',
    })

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
        // validate versions using semver.validate()
        .refine((value) => {
            if (value)
                return semver.validRange(value) !== null

            return true
        }, {
            message: 'Must be a valid semver version',
        }),
    )
    .refine(items => new Set(items.map(item => item)).size === items?.length, {
        message: 'Must be an array of unique strings',
    })

// Php only
export const php_only = z
    .boolean()

// Created At
export const created_at = z.coerce
    .date()

// Updated At
export const updated_at = z.coerce
    .date()

// Laravel Package
export const laravelPackageSchema = z.object({
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
    php_only,
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
            const composer = item.composer
            const npm = item.npm
            return (composer === null || composer.trim() === '') || (npm === null || npm.trim() === '')
        },
        {
            message: 'Either composer or npm can be null or empty, but not both',
        },
    )

// Package Schema
export const laravelPackageArraySchema = z.array(laravelPackageSchema)
    // Make sure the github in the array is unique
    .refine(items => new Set(items.map(item => item.github)).size === items?.length, {
        message: 'Github must be unique in the array',
    })
    // Make sure the composer in the array is unique if it is not null
    .refine(items => new Set(items.filter(item => item.composer !== null).map(item => item.composer)).size === items.filter(item => item.composer !== null)?.length, {
        message: 'Composer must be unique in the array',
    })
    // Make sure the npm in the array is unique if it is not null
    .refine(items => new Set(items.filter(item => item.npm !== null).map(item => item.npm)).size === items.filter(item => item.npm !== null)?.length, {
        message: 'Npm must be unique in the array',
    })