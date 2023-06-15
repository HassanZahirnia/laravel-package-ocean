import inquirer from 'inquirer'
import Fuse from 'fuse.js'
import inquirerPrompt from 'inquirer-autocomplete-prompt'
import { find, isEmpty } from 'lodash'
import axios, { isAxiosError } from 'axios'
import dotenv from 'dotenv'
import chalk from 'chalk'
import ora from 'ora'
import type { packagistData, minimalPackagistData } from '../utils/composer'
import {
    extract_packagist_laravel_dependency_versions,
    extract_packagist_first_release_at,
    extract_packagist_latest_release_at,
} from '../utils/composer'
import { extract_npm_first_release_at, extract_npm_latest_release_at } from '../utils/npm'
import type { NpmData } from '../utils/npm'
import { log } from '../print'
import { github_is_healthy, is_compatible_with_active_laravel_versions } from '../utils/health'
import { generateRSSFeed } from '../utils/rss'
import { readPackagesDatabase, writePackagesDatabase } from '~/ocean-cli/database'
import {
    name as z_name,
    description as z_description,
    github as z_github,
    author as z_author,
    composer as z_composer,
    npm as z_npm,
    keywords as z_keywords,
    laravelPackageSchema,
} from '~/ocean-cli/validations/package.validation'
import { categories } from '~/database/categories'
import type { Package } from '~/types/package'
import type { GithubData } from '~/types/github'
import { packageTypes } from '~/database/packages'

dotenv.config()

// Register the autocomplete prompt
inquirer.registerPrompt('autocomplete', inquirerPrompt)

type Answers = Pick<Package,
    'package_type' | 'name' | 'author' | 'category' | 'description' | 'composer' | 'npm' | 'github' | 'paid_integration'>
    & { keywords: string }

export const addPackage = async function(){
    const laravelPackages = readPackagesDatabase()

    const fuseCategories = new Fuse(categories, {
        minMatchCharLength: 0,
        threshold: 0.2,
    })

    inquirer.prompt([
        {
            type: 'autocomplete',
            name: 'package_type',
            message: 'Package type:',
            source: (answersSoFar: unknown, input = '') => input ? fuseCategories.search(input).map(result => result.item) : packageTypes,
        },
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
            validate: async(value: string) => {
                const result = z_github.safeParse(value)
                if (!result.success)
                    return result.error.errors.map(error => error.message).join('\n')
                if (find(laravelPackages, { github: value }))
                    return 'This package is already in the database'

                try {
                    const { data: githubData }: { data: GithubData } = await axios.get(`https://api.github.com/repos/${value.substring(19)}`, {
                        headers: {
                            Authorization: `Bearer ${process.env.GITHUB_TOKEN}`,
                        },
                    })

                    const health = github_is_healthy(githubData)
                    if (typeof health === 'string')
                        return health

                    return true
                }
                catch (error) {
                    if (isAxiosError(error)) {
                        if (error.response && error.response.status === 404)
                            return 'This GitHub repository does not exist'
                    }
                    else {
                        return error
                    }
                }

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
                if (isEmpty(value))
                    return true
                const result = z_composer.safeParse(value)
                if (!result.success)
                    return result.error.errors.map(error => error.message).join('\n')
                if (find(laravelPackages, { composer: value }))
                    return 'This package is already in the database'

                return true
            },
        },
        {
            type: 'input',
            name: 'npm',
            message: 'Npm(optional, default: null):',
            validate: (value: string) => {
                if (isEmpty(value)) return true
                const result = z_npm.safeParse(value)
                if (!result.success)
                    return result.error.errors.map(error => error.message).join('\n')
                if (find(laravelPackages, { npm: value }))
                    return 'This package is already in the database'

                return true
            },
        },
        {
            type: 'input',
            name: 'keywords',
            message: 'Keywords (optional, separate words with comma):',
            validate: (value: string) => {
                if (isEmpty(value)) return true

                const keywords = value.split(',').map(keyword => keyword.trim())

                const result = z_keywords.safeParse(keywords)
                if (!result.success)
                    return result.error.errors.map(error => error.message).join('\n')

                return true
            },
        },
        {
            type: 'confirm',
            name: 'paid_integration',
            message: 'Does this package integrate with a paid service?',
            default: false,
        },
    ])
        .then(
            async( answers: Answers) => {
                const newPackage: Package = {
                    package_type: answers.package_type,
                    name: answers.name,
                    description: answers.description,
                    category: answers.category,
                    github: answers.github,
                    author: answers.author,
                    composer: isEmpty(answers.composer) ? null : answers.composer,
                    npm: isEmpty(answers.npm) ? null : answers.npm,
                    stars: 0,
                    keywords: isEmpty(answers.keywords) ? [] : answers.keywords.split(',').map(keyword => keyword.trim()),
                    first_release_at: '',
                    latest_release_at: '',
                    laravel_dependency_versions: [],
                    paid_integration: answers.paid_integration,
                    updated_at: new Date().toISOString(),
                    created_at: new Date().toISOString(),
                }

                const spinner = ora('Fetching online information').start()

                if (newPackage.composer){
                    spinner.text = 'Getting packagist data'

                    try {
                        const { data: packagistData }: { data: packagistData }
                            = await axios.get(`https://packagist.org/packages/${newPackage.composer}.json`)

                        const { data: minimalPackagistData }: { data: minimalPackagistData }
                            = await axios.get(`https://repo.packagist.org/p2/${newPackage.composer}.json`)

                        newPackage.first_release_at = extract_packagist_first_release_at(packagistData)
                        newPackage.latest_release_at = extract_packagist_latest_release_at(minimalPackagistData)

                        newPackage.laravel_dependency_versions = extract_packagist_laravel_dependency_versions(minimalPackagistData)

                        if (newPackage.laravel_dependency_versions.length === 0)
                            log(chalk.yellow('\n Could not detect any compatible versions \n'))
                    }
                    catch (error) {
                        if (isAxiosError(error)) {
                            if (error.response && error.response.status === 404)
                                log(chalk.bgRed('\n Composer package does not exist! \n'))
                        }
                        else {
                            log(chalk.bgRed('Unknown error!'))
                        }

                        process.exit(1)
                    }
                }
                else if (newPackage.npm){
                    spinner.text = 'Getting npm data'

                    try {
                        const { data: npmData }: { data: NpmData }
                            = await axios.get(`https://registry.npmjs.org/${newPackage.npm}`)
                        newPackage.first_release_at = extract_npm_first_release_at(npmData)
                        newPackage.latest_release_at = extract_npm_latest_release_at(npmData)
                    }
                    catch (error) {
                        if (isAxiosError(error)) {
                            if (error.response && error.response.status === 404)
                                log(chalk.bgRed('\n Npm package does not exist! \n'))
                        }
                        else {
                            log(chalk.bgRed('Unknown error!'))
                        }

                        process.exit(1)
                    }
                }

                spinner.text = 'Getting github data'

                try {
                    const { data: githubData }: { data: GithubData }
                        = await axios.get(`https://api.github.com/repos/${newPackage.github.substring(19)}`, {
                            headers: {
                                Authorization: `Bearer ${process.env.GITHUB_TOKEN}`,
                            },
                        })
                    newPackage.stars = githubData.stargazers_count
                }
                catch (error) {
                    if (isAxiosError(error)) {
                        if (error.response && error.response.status === 404)
                            log(chalk.bgRed('\n This GitHub repository does not exist! \n'))
                    }
                    else {
                        log(chalk.bgRed('Unknown error!'))
                    }

                    process.exit(1)
                }

                spinner.succeed('Done fetching online information')

                spinner.stop()

                const validationResult = laravelPackageSchema.safeParse(newPackage)

                if (!validationResult.success) {
                    log(chalk.yellow('Validation failed! \n'))
                    log(validationResult.error.errors.map(error => error.message).join('\n'))
                }
                else if (!is_compatible_with_active_laravel_versions(newPackage) && newPackage.package_type === 'laravel-package'){
                    log(chalk.yellow('Package is not compatible with active Laravel versions! \n'))
                }
                else {
                    // Add the new package to the array
                    laravelPackages.push(newPackage)

                    // Write the new package to the database
                    writePackagesDatabase(laravelPackages)

                    // Update RSS
                    generateRSSFeed()

                    // Show a success message
                    log(chalk.magenta('\n Package has been added! \n'))
                }
            },
        )
}