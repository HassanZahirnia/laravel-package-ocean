import inquirer from 'inquirer'
import Fuse from 'fuse.js'
import inquirerPrompt from 'inquirer-autocomplete-prompt'
import { find, isEmpty } from 'lodash'
import type { packagistData } from '../utils/composer'
import { extract_packagist_detected_compatible_versions, extract_packagist_first_release_at, extract_packagist_latest_release_at, fetch_packagist_data } from '../utils/composer'
import { extract_npm_first_release_at, extract_npm_latest_release_at, fetch_npm_data } from '../utils/npm'
import type { npmData } from '../utils/npm'
import { readPackagesDatabase, writePackagesDatabase } from '~/ocean-cli/database'
import {
    name as z_name,
    description as z_description,
    github as z_github,
    author as z_author,
    composer as z_composer,
    npm as z_npm,
    php_only as z_php_only,
} from '~/ocean-cli/validation-rules'
import { log } from '~/ocean-cli/print'
import { categories } from '~/database/categories'
import type { Package } from '~/types/package'

// Register the autocomplete prompt
inquirer.registerPrompt('autocomplete', inquirerPrompt)

export const addPackage = async function(){
    const laravelPackages = readPackagesDatabase()
    
    const fuseCategories = new Fuse(categories, {
        minMatchCharLength: 0,
        threshold: 0.2,
    })

    inquirer.prompt([
        {
            type: 'input',
            name: 'name',
            message: 'Name:',
            validate: (value: string) => {
                const result = z_name.safeParse(value)
                return result.success ? true : result.error.errors.map(error => error.message).join('\n')
            },
            filter: (value: string) => {
                const words = value.split(' ')
                const capitalizedWords = words.map((word) => {
                    return word.charAt(0).toUpperCase() + word.slice(1)
                })
                return capitalizedWords.join(' ')
            },
        },
        {
            type: 'input',
            name: 'description',
            message: 'Description:',
            validate: (value: string) => {
                const result = z_description.safeParse(value)
                return result.success ? true : result.error.errors.map(error => error.message).join('\n')
            },
            filter: (value: string) => {
                // Capitalize the first letter of the description
                // And if the description doesn't end with a period, add one
                return value.charAt(0).toUpperCase() + value.slice(1) + (value.endsWith('.') ? '' : '.')
            },
        },
        {
            type: 'autocomplete',
            name: 'category',
            message: 'Category:',
            source: (answersSoFar: unknown, input = '') => input ? fuseCategories.search(input).map(result => result.item) : categories,
        },
        {
            type: 'input',
            name: 'github',
            message: 'Github:',
            validate: (value: string) => {
                const result = z_github.safeParse(value)
                if(!result.success)
                    return result.error.errors.map(error => error.message).join('\n')
                if(find(laravelPackages, { github: value }))
                    return 'This package is already in the database'

                return true
            },
        },
        {
            type: 'input',
            name: 'author',
            message: 'Author:',
            validate: (value: string) => {
                const result = z_author.safeParse(value)
                return result.success ? true : result.error.errors.map(error => error.message).join('\n')
            },
        },
        {
            type: 'input',
            name: 'composer',
            message: 'Composer(optional, default: null):',
            validate: (value: string) => {
                if(isEmpty(value))
                    return true
                const result = z_composer.safeParse(value)
                if(!result.success)
                    return result.error.errors.map(error => error.message).join('\n')
                if(find(laravelPackages, { composer: value }))
                    return 'This package is already in the database'

                return true
            },
        },
        {
            type: 'input',
            name: 'npm',
            message: 'Npm(optional, default: null):',
            validate: (value: string) => {
                if(isEmpty(value)) return true
                const result = z_npm.safeParse(value)
                if(!result.success)
                    return result.error.errors.map(error => error.message).join('\n')
                if(find(laravelPackages, { npm: value }))
                    return 'This package is already in the database'

                return true
            },
        },
        {
            type: 'confirm',
            name: 'php_only',
            message: 'Is this a PHP only package (does not require Laravel)?',
            default: false,
            validate: (value: boolean) => {
                const result = z_php_only.safeParse(value)
                return result.success ? true : result.error.errors.map(error => error.message).join('\n')
            },
        },
    ])
        .then(
            (answers: Package) => {
                answers.id = laravelPackages.length + 1
                answers.composer = isEmpty(answers.composer) ? null : answers.composer
                answers.npm = isEmpty(answers.npm) ? null : answers.npm
                answers.updated_at = new Date().toISOString()
                answers.created_at = new Date().toISOString()
                answers.stars = 0
                answers.keywords = []
                answers.first_release_at = ''
                answers.latest_release_at = ''
                answers.detected_compatible_versions = []
                answers.compatible_versions = []

                if(answers.composer && !answers.php_only){
                    fetch_packagist_data(answers.composer)
                        .then((data) => {
                            const packagistData = data as packagistData
                            answers.first_release_at = extract_packagist_first_release_at(packagistData)
                            answers.latest_release_at = extract_packagist_latest_release_at(packagistData)
                            answers.detected_compatible_versions = extract_packagist_detected_compatible_versions(packagistData)

                            laravelPackages.push(answers)

                            writePackagesDatabase(laravelPackages)
                        })
                        .catch((error) => {
                            log(error)
                        })
                }
                else if(answers.npm){
                    fetch_npm_data(answers.npm)
                        .then((data) => {
                            const npmData = data as npmData
                            answers.first_release_at = extract_npm_first_release_at(npmData)
                            answers.latest_release_at = extract_npm_latest_release_at(npmData)

                            laravelPackages.push(answers)

                            writePackagesDatabase(laravelPackages)
                        },
                        )
                        .catch((error) => {
                            log(error)
                        },
                        )
                }
                else{
                    laravelPackages.push(answers)

                    writePackagesDatabase(laravelPackages)
                }
            },
        )
}