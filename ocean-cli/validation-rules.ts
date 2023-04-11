import { z } from 'zod'
import { categories } from '~/database/categories'

// Id
export const id = z
    .number()
    .int()

// Name
export const name = z
    .string()
    .min(2)
    .max(40)
    .regex(/^(?!.*[\-\+\(\)&]{2})[0-9a-zA-Z\-\+\(\)&]+(\s[0-9a-zA-Z\-\+\(\)&]+)*$/)
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
            message: 'Each word in the name should be capitalized',
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

// Category
export const category = z
    .enum(categories as [string, ...string[]])

// Github
export const github = z
    .string()
    .url()
    .min(19)
    .startsWith('https://github.com/')
    .regex(/^https:\/\/github\.com\/[a-zA-Z0-9\-_]+\/[a-zA-Z0-9\-_.]+$/i)

// Author
export const author = z
    .string()
    .nonempty()
    .min(2)
    .regex(/^[a-zA-Z0-9\-]+$/)

// Composer
export const composer = z
    .union([
        z
            .string()
            .min(2)
            .regex(/^[a-z0-9]+(?:-[a-z0-9]+)*\/[a-z0-9]+(?:-[a-z0-9]+)*$/i)
            .refine((value) => {
                const packageName = value.split('/')[1]
                return packageName.length >= 1 && packageName.length <= 100
            }, 'Invalid composer package name'),
        z
            .null(),
    ])

// Npm
export const npm = z
    .union([
        z
            .string()
            .min(2)
            .regex(/^(?!-)(?!.*--)[a-zA-Z0-9_.-]+$/),
        z
            .null(),
    ])

// Stars
export const stars = z
    .number()
    .nonnegative()

// Keywords
export const keywords = z
    .array(z
        .string()
        .nonempty(),
    )
    .refine(items => new Set(items).size === items.length, {
        message: 'Must be an array of unique strings',
    })

// First Release At
export const first_release_at = z
    .date()

// Latest Release At
export const latest_release_at = z
    .date()

// Detected Compatible Versions
export const detected_compatible_versions = z
    .array(z
        .string()
        .regex(/^(\d+|<=\d+|<\d+|>=\d+|>\d+)$/),
    )
    .refine(items => new Set(items.map(item => item)).size === items.length, {
        message: 'Must be an array of unique strings',
    })

// Compatible Versions
export const compatible_versions = detected_compatible_versions

// Php only
export const php_only = z
    .boolean()

// Created At
export const created_at = z
    .date()

// Updated At
export const updated_at = z
    .date()

// Laravel Package
export const laravelPackage = z.object({
    id,
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
    detected_compatible_versions,
    compatible_versions,
    php_only,
    created_at,
    updated_at,
})

// Package Schema
export const laravelPackageSchema = z.array(laravelPackage)
    // Make sure the github in the array is unique
    .refine(items => new Set(items.map(item => item.github)).size === items.length, {
        message: 'Github must be unique in the array',
    })
    // Make sure the id in the array is unique
    .refine(items => new Set(items.map(item => item.id)).size === items.length, {
        message: 'Id must be unique in the array',
    })
    // Make sure the composer in the array is unique if it is not null
    .refine(items => new Set(items.filter(item => item.composer !== null).map(item => item.composer)).size === items.filter(item => item.composer !== null).length, {
        message: 'Composer must be unique in the array',
    })
    // Make sure the npm in the array is unique if it is not null
    .refine(items => new Set(items.filter(item => item.npm !== null).map(item => item.npm)).size === items.filter(item => item.npm !== null).length, {
        message: 'Npm must be unique in the array',
    })