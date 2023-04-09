import inquirer from 'inquirer'
import Fuse from 'fuse.js'
import inquirerPrompt from 'inquirer-autocomplete-prompt'
import MiniSearch from 'minisearch'
import { showPackageMenu } from '~/ocean-cli/package/menu'
import { Package } from '~/models/Package'
import { clearScreen, log } from '~/ocean-cli/print'
import { categories } from '~/database/categories'

// Register the autocomplete prompt
inquirer.registerPrompt('autocomplete', inquirerPrompt)

export const addPackage = async function(){
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
                if (value.trim() === '')
                    return 'Name is required'
            
                if (!/^[a-zA-Z\s]+$/.test(value))
                    return 'Name must contain only English letters and spaces'
            
                if (/\s{2,}/.test(value))
                    return 'Name must not contain multiple spaces between words'

                if (value.length < 2 || value.length > 40)
                    return 'Name must be between 2 and 40 characters'
            
                return true
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
                if (value.trim() === '')
                    return 'Description is required'

                if (!/^[a-zA-Z]/.test(value))
                    return 'Description must start with a letter'
            
                if (/\s{2,}/.test(value))
                    return 'Description must not contain multiple spaces between words'

                if (value.length < 5 || value.length > 100)
                    return 'Description must be between 5 and 100 characters'
            
                return true
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
                if (value.trim() === '')
                    return 'Github is required'

                try {
                    new URL(value)
                }
                catch (error) {
                    return 'Github must be a valid URL'
                }

                if (!/^https:\/\/github\.com\/[a-zA-Z0-9\-_]+\/[a-zA-Z0-9\-_.]+$/i.test(value))
                    return 'Github must be a valid GitHub repository link'

                if (value.length < 20)
                    return 'Github must be longer than 20 characters'

                if (await Package.query().where('github', value).first())
                    return 'This package already exists in the database'

                return true
            },
        },
        {
            type: 'input',
            name: 'author',
            message: 'Author:',
            validate: async(value: string) => {
                if (value.trim() === '') 
                    return 'Author is required'

                if (value.length < 2)
                    return 'Author must be longer than 2 characters'

                if (!/^[a-zA-Z0-9\-]+$/.test(value))
                    return 'Author must only consist of alphanumeric characters and dashes'
                return true
            },
        },
        {
            type: 'input',
            name: 'composer',
            message: 'Composer(optional, default: null):',
            default: null,
            validate: async(value: string) => {
                if (value.trim() === '' || value === null) 
                    return true

                if (value.length < 2)
                    return 'Composer must be longer than 2 characters'

                if (!/^[a-zA-Z0-9][a-zA-Z0-9\-]*(?!.*\/\/)[a-zA-Z0-9]\/[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9]$/.test(value))
                    return 'Composer must be in the format "vendor/package"'

                return true
            },
        },
        {
            type: 'input',
            name: 'npm',
            message: 'Npm(optional, default: null):',
            default: null,
            validate: async(value: string) => {
                if (value.trim() === '' || value === null) 
                    return true

                if (value.length < 2)
                    return 'Npm must be longer than 2 characters'

                if (!/^[a-zA-Z0-9][a-zA-Z0-9\-]*(?!.*\/\/)[a-zA-Z0-9]\/[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9]$/.test(value))
                    return 'Npm must be in the format "vendor/package"'

                return true
            },
        },
        {
            type: 'confirm',
            name: 'php_only',
            message: 'Is this a PHP only package (does not require Laravel)?',
            default: false,
        },
    ])
        .then(
            async(answers) => {
                log(answers)
            },
        )
}